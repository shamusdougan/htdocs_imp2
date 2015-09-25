<?php
use app\models\Client;
use app\models\ClientContact;


require_once("SyncModelBase.php");

class syncLabtechContact extends syncModelBase

{
	
	var $syncType = syncModelBase::DUALSYNC;
	
	var $dataIndex = array("imp" => "FK1", "remote" => "ContactID");
	var $dataLastChangeFields = array("imp" => "last_change", "remote" => "Last_Date");

	
	//mapping array are all From->To ("impFieldName" => "RemoteFieldName")
	var $fieldMapping = [
		"firstname" => "Firstname",
		"surname" => "LastName",
		"phone1" => "Phone",
		"phone2" => "Fax",
		"mobile" => "Cell",
		"email" => "Email",
		"address" => "Address1",
		'City' => 'City',
		'Postcode' => 'Zip',
		'State' => 'State',

		];
	
	var $dbConnection;
	
	/*
		Function: getRemoteRecordsChangedSince
		input
		$dateTime: the given date/time of the last successfuly syncLabtechClient
		$dbconnection: the connection to the foreign database
		output:
		should return anarray of records changed since the last sync, the array should be indexed on record id.	*/
	function getRemoteRecordsChangedSince($syncRelationship)
		{
		try{
			$sqlQuery = "Select * From ".$syncRelationship->endPointDBTable." WHERE ".$syncRelationship->endPointDBTable.".Last_Date > '".$syncRelationship->lastSync."'";
			$updatedRemoteRecords = $this->dbConnection->createCommand($sqlQuery)->queryAll();

			}
		catch(Exception $e)
		{
			return "Error in fetching Foreign Data, Error: ".$e->getMessage();	
		}
		return $updatedRemoteRecords;
		}



	/*
		Function: getLocalRecordsChangedSince
		input
		$dateTime: the given date/time of the last successfuly syncLabtechClient
		output:
		should return anarray of records changed since the last sync, the array should be indexed on record id. */
	function getLocalRecordsChangedSince($syncRelationship)
		{
		return ClientContact::find()
			->joinWith('client')
			->where("client_contact.last_change > '".$syncRelationship->lastSync."' AND client.labtech = 1")
			->asArray()->all();
		}


	
	
	
	
	/*
		function: transferFromRemote()
		inputs: none
		output: none
		description: takes the list of records from the internal $this->remoteRecords and transfers to the local database.
					this uses the yii2 object to create and save so that the transfered object adheres to the valiadations rules
	*/
	function transferFromRemote()
	{
		
		//Itereate through each record, find local record and update. Or create the new record if it doesn't exist locally'
		foreach($this->remoteRecords as $remoteRecord)
			{
				$localContactRecord = ClientContact::find()->where($this->dataIndex['imp']."=".$remoteRecord[$this->dataIndex['remote']])->one();
				
				//no local record found for that Contct, need to create a new contact and set the default values
				if(!$localContactRecord)
					{
					$localContactRecord =  new ClientContact();
					
					$localFK = $this->dataIndex['imp'];
					$localContactRecord->$localFK = $remoteRecord[$this->dataIndex['remote']];
								
					//there are single user in labtech with no client attached so ignore that one, but also check is the local client exists
					if($remoteRecord['ClientID'] == 0)
						{
						continue;
						}
					else
						{
						$client = Client::find()->where(['FK1' => $remoteRecord['ClientID']])->one();
						if(!$client){
							$this->progress .= "Unable to transfer record from remote source, unable to locate Local Client with the FK1 of : ".$remoteRecord['ClientID']."\n";
							continue;
							}	
						}
					
					
					$localContactRecord->client_id = $client->id;
					$this->localRecordsCreated++;
					}

				//mapp the datafields
				foreach($this->fieldMapping as $impFieldName => $remoteFieldName)
					{
					if(!array_key_exists($remoteFieldName, $remoteRecord))
						{
						$this->progress .= "Invalid Field Name :".$remoteFieldName."\n";
						continue;
						}
					$localContactRecord->$impFieldName = $remoteRecord[$remoteFieldName];	
					}
				
				//save the object, if the save failes report the error
				if(!$localContactRecord->Save())
					{
					$this->progress .= "Failed to Save local Client Rcord for Contact Name: ".$localContactRecord->firstname."\n ";
					foreach($localContactRecord->getErrors() as $error)
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
	
	
	/*
		function: transfeToRemote()
		inputs: none
		output: none
		description: takes the list of records from the internal $this->localRecords and transfers to the remote database.
					this uses the SQL statements to transfer the data into the remote database
	*/
	function transferToRemote($syncRelationship)
	{
	
	
	
	foreach($this->localRecords as $localRecord)
		{
			
			
			
			
			//For a new record the local FK field would not have been set.
			if(!isset($localRecord[$this->dataIndex['imp']]))
				{
					
				//Fetch the new ClientID data from the database, cause Labtech doesn't like Autoincrement :('
				try{
					$sqlQuery = "Select * From `".$syncRelationship->endPointDBTable."` ORDER BY `ClientID` DESC LIMIT 1 ";
					$updatedRemoteRecords = $this->dbConnection->createCommand($sqlQuery)->queryAll();
					$nextClientID = $updatedRemoteRecords[0]['ClientID'] + 1;
					$nextSecurityID = $updatedRemoteRecords[0]['Permissions'] + 1;
					}
				catch(Exception $e)
				{
					$this->progress .= "Error in fetching Foreign Data, Error: ".$e->getMessage()."\n";	
				}					
					

				$sqlStatement = "INSERT INTO `".$syncRelationship->endPointDBTable."` ";
				
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
					"'".$localRecord['name']."'",
					]; 
					
				foreach($this->fieldMapping as $impFieldName => $remoteFieldName)
					{
						$columns[] = "`".$remoteFieldName."`";
						$dataValue[] = "'".$localRecord[$impFieldName]."'";
					}
				$sqlStatement .= "(".implode($columns, ", ").") VALUES (".implode($dataValue, ", ").")";
				
				
				
				//update the local Foreign key
				$clientRecord = Client::findOne($localRecord);
				$remoteKeyAttribute = $this->dataIndex['imp'];
				$clientRecord->$remoteKeyAttribute = $nextClientID;
				$clientRecord->save();
				
				$this->progress .= "   Creating new Client Entry in Labtech Database \n";
				
				}
			else{
				
				$sqlStatement = "UPDATE `".$syncRelationship->endPointDBTable."` SET ";
				$fields = array();
				//update the last time saved and the change source
				$fields[] = "`Last_Date` = '".date("Y-m-d H:i:s")."'";
				$fields[] = "`Last_User` = 'Imp@sync_engine'";
				foreach($this->fieldMapping as $impFieldName => $remoteFieldName)
					{
						$fields[] = "`".$remoteFieldName."` = '".$localRecord[$impFieldName]."'";
					}
			
				
					
					
				$sqlStatement .= implode($fields, ", ")." WHERE ".$this->dataIndex['remote']." = ".$localRecord[$this->dataIndex['imp']];
				
				$this->progress .= $sqlStatement."\n";
				}
			
			
			try{
				$this->dbConnection->createCommand($sqlStatement)->query();
				}
			catch(Exception $e)
				{
				$this->progress .= "Error in updating Foreign Data, Error: ".$e->getMessage()."\n";	
				}

		}
	}
	
	
	
	
	
	
}


?>