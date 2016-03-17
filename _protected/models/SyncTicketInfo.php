<?php
use app\models\TicketInfo;
use app\models\Client;
use app\models\Computers;


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
		
		
		
		$this->progress .= "Fetching any records in labtech that dont't have the coresponding ticket info object in imp\n";
		try{
			
			$sqlQuery = "Select * From ".$this->databaseTable." A LEFT JOIN Sapient_imp.".ticketInfo::tableName()." B ON A.TicketID = B.labtech_ticket_id WHERE B.labtech_ticket_id IS NULL AND A.StartedDate > '".$this->startingDate."'";
			$this->remoteRecords = $this->dbConnection->createCommand($sqlQuery)->queryAll();
			}
		catch(Exception $e)
			{
				$this->progress .= "Error in fetching Foreign Data, Error: ".$e->getMessage();	
			}

		$clientList = Client::getClientList(Client::LABTECH_KEY);
		
		$this->progress .= "Creating Local Data copies of Labtech Tickets\n";
		foreach($this->remoteRecords as $remoteRecord)
			{
				
				
			//Check the data is valid
			if(!array_key_exists($remoteRecord['ClientID'], $clientList))
				{
				$this->progress .= "Unable to locate client for ticket ".$remoteRecord['TicketID']."\n";
				$this->errorCount++;
				
				}
			else{
				$newTicketInfo = new TicketInfo();
				$newTicketInfo->labtech_ticket_id = $remoteRecord['TicketID'];
				$newTicketInfo->imp_status = TicketInfo::DEFAULT_STATUS;
				$newTicketInfo->client_id = $clientList[$remoteRecord['ClientID']]->id;
				
				$newTicketInfo->default_charge_rate_id = $clientList[$remoteRecord['ClientID']]->getDefaultChargeRate($remoteRecord['ComputerID']);
				$newTicketInfo->default_billing_account_id = $clientList[$remoteRecord['ClientID']]->agreement->default_account_id;
				$newTicketInfo->labtech_computer_id = $remoteRecord['ComputerID'];
				$newTicketInfo->save();
				if(!$newTicketInfo->save())
					{
						$errors = $newTicketInfo->getErrors();
						foreach($errors as $errorType)
							{
							foreach($errorType as $errorText)
								{
								$this->progress .= $errorText."\n";
								}
							}
						$this->errorCount++;
						
						
					}
				else{
					$this->localRecordsUpdated++;
					}
				}
			}	


		$this->progress .= "Checking for any updates to the Computer assigned to the ticket. If the computer as changed sinxe last check the chrge rates will also need tobe checked\n";
		$ticketInfoList = TicketInfo::getTicketInfoLast(50);
		foreach($ticketInfoList as $ticketInfo)
			{
			
			//check to see if the ticket actually exists, if it has been deleted then also delete the TicketInfo
			if(is_string(($update = $ticketInfo->checkTicket())))
				{
				$this->progress .= $update;
				$this->localRecordsUpdated++;
				break;
				}
			
			//Check to see if the computer assigned to the ticket has changed
			if(is_string(($update = $ticketInfo->checkComputerID())))
				{
				$this->progress .= $update;
				$this->localRecordsUpdated++;
				}
			}








		$this->progress .= $this->localRecordsUpdated." Local Records Updated\n";
		$this->progress .= $this->errorCount." Errors encounted during Sync\n";
		
	}
	
	

	



}


?>