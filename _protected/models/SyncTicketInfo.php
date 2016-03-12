<?php
use app\models\TicketInfo;


require_once("SyncModelBase.php");

class syncTicketInfo extends syncModelBase

{
	
	var $syncType = syncModelBase::DUALSYNC;
	
	var $dataIndex = array("imp" => "FK1", "remote" => "ClientID");
	var $dataLastChangeFields = array("imp" => "last_change", "remote" => "Last_Date");
	var $databaseName = "labtech";
	var $databaseTable = "tickets";
	var $startingDate = "2014-06-01";
	
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
		
		
		
		$this->progress .= "Fetching any records in labtech that dont't have the coresponding tickinfo object in imp\n";
		try{
			
			$sqlQuery = "Select * From ".$this->databaseTable." A LEFT JOIN Sapient_imp.".ticketInfo::tableName()." B ON A.TicketID = B.labtech_ticket_id WHERE B.labtech_ticket_id IS NULL AND A.StartedDate > '".$this->startingDate."'";
			$this->remoteRecords = $this->dbConnection->createCommand($sqlQuery)->queryAll();
			}
		catch(Exception $e)
			{
				$this->progress .= "Error in fetching Foreign Data, Error: ".$e->getMessage();	
			}


		foreach($this->remoteRecords as $remoteRecord)
			{
			$newTicketInfo = new TicketInfo();
			$newTicketInfo->labtech_ticket_id = $remoteRecord['TicketID'];
			$newTicketInfo->imp_status = TicketInfo::DEFAULT_STATUS;
			$newTicketInfo->charge_rate_id = ChargeRates::
			}	
		
	}
	
	/*
		Function: getRemoteRecordsChangedSince
		input
		$dateTime: the given date/time of the last successfuly syncLabtechClient
		$dbconnection: the connection to the foreign database
		output:
		should return an array of records changed since the last sync, the array should be indexed on record id.	*/
	function  getRemoteRecords($syncRelationship)
		{
		try{
			$modelName = $syncRelationship->impModelName;
			$sqlQuery = "Select * From ".$syncRelationship->endPointDBTable." A LEFT JOIN Sapient_imp.".ticketInfo::tableName()." B ON A.TicketID = B.labtech_ticket_id WHERE B.labtech_ticket_id IS NULL LIMIT 10";
			$remoteRecords = $this->dbConnection->createCommand($sqlQuery)->queryAll();

			}
		catch(Exception $e)
			{
				return "Error in fetching Foreign Data, Error: ".$e->getMessage();	
			}
		return $remoteRecords;	
		}
	/**
	* 
	* @param undefined $remoteRecords
	* This function will take the list of remote records and create the required local records. The local record values will be populated via the defaults defined in this section
	* @return
	*/
	function createLocalRecords($remoteRecords)
	{
		
	}


}


?>