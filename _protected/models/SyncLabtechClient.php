<?php
use app\models\Client;


require_once("SyncModelBase.php");

class syncLabtechClient extends syncModelBase

{
	
	var $syncType = syncModelBase::DUALSYNC;
	
	var $dataIndex = array("imp" => "FK1", "remote" => "ClientID");
	
	//mapping array are all From->To ("impFieldName" => "RemoteFieldName")
	var $mappingToRemote = [
		"name" => "Name",
		"address" => "Address1",
		"city" => "City",
		"state" => "State",
		"postcode" => "Zip",
		"phone1" => "Phone",
		];
		
	var $mappingFromRemote = [
		"name" => "Name",
		"address" => "Address1",
		"city" => "City",
		"state" => "State",
		"postcode" => "Zip",
		"phone1" => "Phone",
		];
	
	
	
	/*
		Function: getRemoteRecordsChangedSince
		input
		$dateTime: the given date/time of the last successfuly syncLabtechClient
		$dbconnection: the connection to the foreign database
		output:
		should return anarray of records changed since the last sync, the array should be indexed on record id.	*/
	function getRemoteRecordsChangedSince($syncRelationship, $dbConnection)
		{
		try{
			$sqlQuery = "Select * From ".$syncRelationship->endPointDBTable." WHERE ".$syncRelationship->endPointDBTable.".Last_Date > '".$syncRelationship->lastSync."'";
			$updatedRemoteRecords = $dbConnection->createCommand($sqlQuery)->queryAll();

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
		$dbconnection: the connection to the foreign database
		output:
		should return anarray of records changed since the last sync, the array should be indexed on record id. */
	function getLocalRecordsChangedSince($syncRelationship, $dbConnection)
		{
		return Client::find()->where("last_change > '".$syncRelationship->lastSync."'")->asArray()->all();
		}


	
	
	/*
	Function: checkConflicts()
	input:
		$localRecords -> an array of local records, inrementing index
		$remoteRecords -> an array of remote records, incrementing IndexAction
	output: none
	Description: this function takes the two list and checks for any conflicts in the data records. The newest record is taken to be
				the authorative record, and the old record will be unset. */
	function checkConflicts()
	{

	foreach($this->localRecords as $localRecordIndex => $localRecord)
		{
		$impKey = $this->dataIndex['imp'];
		$remoteKey = $this->dataIndex['remote'];
		
		
		$remoteRecordIndex = array_search($localRecord[$impKey], array_column($this->remoteRecords, $remoteKey));
		
		
	
		
		if($remoteRecordIndex !== false)
			{
			$this->progress .= "found conflicting record for ".$localRecord['name']."\n";
			$this->recordConflicts++;
			
			$this->progress .= "Comapring ".$localRecord['last_change']." to ".$this->remoteRecords[$remoteRecordIndex]["Last_Date"]."\n";
			$this->progress .= $localRecord['last_change'] >= $this->remoteRecords[$remoteRecordIndex]['Last_Date'];
	
			
			
			if($localRecord['last_change'] >= $this->remoteRecords[$remoteRecordIndex]['Last_Date'])
				{
				unset($this->remoteRecords[$remoteRecordIndex]); 
				}
			else{
				unset($this->localRecords[$localRecordIndex]);
				}
			
			}
		
		}
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
				$localClientRecord = Client::find()->where($this->dataIndex['imp']."=".$remoteRecord[$this->dataIndex['remote']])->one();
				
				//no local record found for that client, need to create a new client`
				if(!$localClientRecord)
					{
					$this->progress .= " create new local record\n";
					$localClientRecord =  new Client();
					$localClientRecord->defaultBillingType = 1;
					$localClientRecord->defaultBillingRate = 1;
					$localFK = $this->dataIndex['imp'];
					$localClientRecord->$localFK = $remoteRecord[$this->dataIndex['remote']];
					$this->localRecordsCreated++;
					}

				//mapp the datafields
				foreach($this->mappingFromRemote as $impFieldName => $remoteFieldName)
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


?>