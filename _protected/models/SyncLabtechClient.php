<?php
use app\models\Client;
use yii\helpers\ArrayHelper;


require_once("SyncModelBase.php");

class syncLabtechClient extends syncModelBase

{
	
	var $syncType = syncModelBase::DUALSYNC;
	
	var $dataIndex = array("imp" => "FK1", "remote" => "ClientID");
	var $dataLastChangeFields = array("imp" => "last_change", "remote" => "Last_Date");
	var $databaseName = "labtech";
	var $databaseTable = "clients";

	
	//mapping array are all From->To ("impFieldName" => "RemoteFieldName")
	var $fieldMapping = [
		"name" => "Name",
		"address" => "Address1",
		"city" => "City",
		"state" => "State",
		"postcode" => "Zip",
		"phone1" => "Phone",
		"phone2" => "Fax",
		'notes' => 'Comment'
		];
	
	var $dbConnection;
	
	
	function executeSync($syncRelationship)
	{
		
		
		
		$this->progress = "Attempting Sync client information between IMP (me) and Labtech using ".$syncRelationship->endPoint."\n";
		$this->dbConnection = $this->connectDatabase($syncRelationship, $this->databaseName, $this->databaseTable);
		if(is_string($this->dbConnection))
			{
			$this->progress .= $this->dbConnection;
			return;
			}
		$this->progress .= "   ....Connected \n";
		
		/**
		* 
		* Fetching the remote data records are indexed by the ClientID property
		* 
		*/
		$this->progress .= "Fetching remote records to sync \n";			
		try{
			$sqlQuery = "Select * From ".$this->databaseTable;
			$remoteResults = $this->dbConnection->createCommand($sqlQuery)->queryAll();
			$this->remoteRecords = ArrayHelper::index($remoteResults, 'ClientID');	
			}
		catch(Exception $e)
		{
			$this->progress .=  "Error in fetching Foreign Data, Error: ".$e->getMessage();	
			return;
		}	
		$this->progress .= "  ".count($this->remoteRecords)." Records Retrieved from Remote Source\n";
		
		/**
		* 
		* Local records are indexed by the id field from imp
		* 
		*/
		$this->progress .= "Fetching IMP records \n";
		$localResults = Client::find()
								->where("labtech = 1")
								->asArray()->all();
		$this->localRecords = ArrayHelper::index($localResults, 'id');						
								
								
		if(is_string($this->localRecords))
			{
			$this->progress .= 	$this->localRecords."\n";
			return;		
			}
		$this->progress .= "  ".count($this->localRecords)." Records Retrieved from Imp\n";
	
		
		//print_r($this->localRecords);

		//print_r($this->remoteRecords);
		
		//OK from this point we have two arrays, the array of imp records that have changed since the last syncLabtechClient
		//and the array of records of the foreign datasource that have changed since the last sync was carried out.
		//$localRecords -> Imp models as an array
		//$remoteRecords -> Foreigns changes in an assoicated array of data. not index by id but by number
		$this->progress .= "Syncing details IMP details will overright the details in labtech if both have changed at the same time otherwise the latest change will sync over \n";


		foreach($this->localRecords as $impID => $impRecord)
			{
			//for the case of the imp record has no matching Labtech record
			if($impRecord['FK1'] == null)
				{
				$this->progress .= "Imp Record: ".$impID." Not found in Labtech creating labtech record\n";
				$FK1 = $this->createLabtechClient($impID);
				
				//update the local record with the Foreign key value
				$impRecord = Client::findOne($impRecord['id']);
				$impRecord->FK1 = $FK1;
				$impRecord->save();
				}
			else{
				$this->syncRecord($impRecord, $syncRelationship);
				}	
			}		
			
		//check for any records that are in Labtech but not imp
		$localResults = Client::find()
							->where("labtech = 1")
							->asArray()->all();
		$FK1array = ArrayHelper::index($localResults, $this->dataIndex['imp']);
		foreach($this->remoteRecords as $remoteRecord)
			{
			if(!array_key_exists($remoteRecord[$this->dataIndex['remote']], $FK1array))
				{
				$this->progress .= "Creating an imp record \n";
				$this->createImpClient($remoteRecord[$this->dataIndex['remote']]);
				}
			}
		
		
		$this->progress .= "    \n";
		$this->progress .= "Imp Records \n";
		$this->progress .= "	Created ".$this->localRecordsCreated." new Records\n";
		$this->progress .= "	Updated ".$this->localRecordsUpdated." Records\n";
		$this->progress .= "Labtech Records \n";
		$this->progress .= "	Created ".$this->remoteRecordsCreated." new Records\n";
		$this->progress .= "	Updated ".$this->remoteRecordsUpdated." Records\n";
	
		$this->progress .= "\n\nSync Completed at ".date("H:m d-M-Y")."\n";
		$syncRelationship->lastSync = date("Y-m-d H:i:s");
		$syncRelationship->LastStatus = syncModelBase::SYNC_SUCCESS;
		$syncRelationship->save();
		return;

	}
	
	
/**
* Function createLabtech Client
* Description: this function creates a labtech client, I've only inlcuded the basic creation in a singal table at this point in time, it will need to be fleshed out better later on'
* 
* @return
*/
public function  createLabtechClient($impID)
	{
	
	$impRecord = $this->localRecords[$impID];
	
	try{
		$sqlQuery = "Select * From `".$this->databaseTable."` ORDER BY `ClientID` DESC LIMIT 1 ";
		$updatedRemoteRecords = $this->dbConnection->createCommand($sqlQuery)->queryAll();
		$nextClientID = $updatedRemoteRecords[0]['ClientID'] + 1;
		$nextSecurityID = $updatedRemoteRecords[0]['Permissions'] + 1;
		}
	catch(Exception $e)
		{
		$this->progress .= "Error in fetching Foreign Data, Error: ".$e->getMessage()."\n";	
		}		

	
	$sqlStatement = "INSERT INTO `".$this->databaseTable."` ";
				
	//Default columns for creating a labtech agent that dont come from imp
	$columns = 
		[
		"`ClientID`", 
		"`Firstname`",
		"`LastName`",
		"`Address2`",
		"`Last_Date`",
		"`Last_User`",
		"`Country`",
		"`SupportMins`",
		"`ExternalID`",
		"`Flags`",
		"`GUID`",
		"`Permissions`",
		"`Score`",
		"`Company`",
		];
		
	//Default values for the default columns that dont come from imp
	$dataValue = 
		[
		$nextClientID,
		"''",
		"''",
		"''",
		"'".date("Y-m-d H:i:s")."'",
		"'Imp@sync_engine'",
		"''",
		0,
		0,
		0,
		"''",
		$nextSecurityID,
		0,
		"'".$impRecord['name']."'",
		]; 
		
	foreach($this->fieldMapping as $impFieldName => $remoteFieldName)
		{
			$columns[] = "`".$remoteFieldName."`";
			$dataValue[] = "'".$impRecord[$impFieldName]."'";
		}
	$sqlStatement .= "(".implode($columns, ", ").") VALUES (".implode($dataValue, ", ").")";
	
	
	try{
		$results = $this->dbConnection->createCommand($sqlStatement)->query();
		}
	catch(Exception $e)
		{
		$this->progress .=  "Error in pushing Foreign Data, Error: ".$e->getMessage();	
		return;
		}	
		
	$this->remoteRecordsCreated++;
	return $nextClientID;
	}
	
	
	
	public function syncRecord($impRecord, $syncRelationship)
		{
		$impRecordAge = strtotime($impRecord[$this->dataLastChangeFields['imp']]);
		$remoteRecord = $this->remoteRecords[$impRecord[$this->dataIndex['imp']]];
		$remoteRecordAge = strtotime($remoteRecord[$this->dataLastChangeFields['remote']]);
		$lastSyncTime = strtotime($syncRelationship->lastSync);
		
		//if either one of the records has changed since the last sync then perform sync
		if($impRecordAge > $lastSyncTime || $remoteRecordAge > $lastSyncTime)
			{
			//if imp has a newer record then overwrite the remote record
			if($impRecordAge > $remoteRecordAge)
				{
				$sqlStatement = "UPDATE `".$this->databaseTable."` SET ";
				$fields = array();
				foreach($this->fieldMapping as $impFieldName => $remoteFieldName)
					{
						$fields[] = "`".$remoteFieldName."` = '".$impRecord[$impFieldName]."'";
					}
				$sqlStatement .= implode($fields, ", ")." WHERE ".$this->dataIndex['remote']." = ".$impRecord[$this->dataIndex['imp']];
				
			
			
				try{
					$this->dbConnection->createCommand($sqlStatement)->query();
					}
				catch(Exception $e)
					{
					$this->progress .= "Error in updating Foreign Data, Error: ".$e->getMessage()."\n";	
					}	
				$this->remoteRecordsUpdated++;				
				}
				
				
			//if the remote record is newer
			else{
				$localClientRecord = Client::find()->where($this->dataIndex['imp']."=".$remoteRecord[$this->dataIndex['remote']])->one();
			

				//mapp the datafields
				foreach($this->fieldMapping as $impFieldName => $remoteFieldName)
					{
					$localClientRecord->$impFieldName = $remoteRecord[$remoteFieldName];	
					}
				
				//save the object, if the save failes report the error
				if(!$localClientRecord->Save())
					{
					$this->progress .= "Failed to Save local Client Rcord for client Name: ".$localClientRecord->name."\n ";
					foreach($localClientRecord->getErrors() as $error)
						{
						$this->progress .= $error[0]."\n";
						}	
					$this->errorCount++;
					}
				else{
					$this->localRecordsUpdated++;
					}
				
				}
			}
		}



	public function createImpClient($remoteID)
		{
		$localClientRecord =  new Client();
		$localClientRecord->defaultBillingType = 1;
		$localClientRecord->defaultBillingRate = 1;
		$localClientRecord->labtech = 1;
		$localFK = $this->dataIndex['imp'];
		$localClientRecord->$localFK = $remoteID;	
			
			
		//mapp the datafields
		foreach($this->fieldMapping as $impFieldName => $remoteFieldName)
			{
			$localClientRecord->$impFieldName = $this->remoteRecords[$remoteID][$remoteFieldName];	
			}
		
		//save the object, if the save failes report the error
		if(!$localClientRecord->Save())
			{
			$this->progress .= "Failed to Save local Client Rcord for client Name: ".$localClientRecord->name."\n ";
			foreach($localClientRecord->getErrors() as $error)
				{
				$this->progress .= $error[0]."\n";
				}	
			$this->errorCount++;
			}
		else{
			$this->localRecordsCreated++;
			}
			
			
		}	
	
}


?>