<?php
use app\models\Client;


require_once("SyncModelBase.php");

class syncLabtechClient extends syncModelBase

{
	
	var $syncType = syncModelBase::DUALSYNC;
	
	var $dataIndex = array("imp" => "FK1", "remote" => "ClientID");
	var $dataFromImpMapping = [
		"name" => "Name",
		"address" => "Address1",
		"city" => "City",
		"state" => "State",
		"postcode" => "Zip",
		"phone1" => "Phone",
		];
		
	var $dataToImpMapping = [
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
			$this->progress .= "found conflicting record for ".$localRecordIndex."\n";
			if($localRecord['last_change'] >= $this->remoteRecords[$remoteRecordIndex]['Last_date'])
				{
				unset($this->remoteRecords[$remoteRecordIndex]); 
				}
			else{
				unset($this->localRecords[$localRecordIndex]);
				}
			}
		}
	}
	
	
	function transerFromRemote()
	{
		
	}
	
	
	
	
}


?>