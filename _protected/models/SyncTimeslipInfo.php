<?php
use app\models\TimeslipInfo;
use app\models\TicketInfo;
use app\models\Client;
use app\models\Computers;
use app\models\SyncRelationships;
use app\models\Lookup;
use app\models\ChargeRates;
use app\models\Accounts;
use app\models\LabtechTickets;


require_once("SyncModelBase.php");

class syncTimeslipInfo extends syncModelBase

{
	
	
	
	
	var $databaseName = "labtech";
	var $databaseTable = "timeslips";
	var $startingDate = "2014-06-01";
	
	var $dbConnection;
	
	
	
	function executeSync($syncRelationship)
	{
		
		$this->progress = "Attempting Sync Timeslip information between IMP (me) and Labtech using ".$syncRelationship->endPoint."\n";
		$this->dbConnection = $this->connectDatabase($syncRelationship, $this->databaseName, $this->databaseTable);
		if(is_string($this->dbConnection))
			{
			$this->progress .= $this->dbConnection;
			return;
			}
		$this->progress .= "   ....Connected \n";
		
		
		
		$this->progress .= "Fetching any records in labtech that dont't have the coresponding ticket info object in imp\n";
		try{
			
			$sqlQuery = "Select * From ".$this->databaseTable." A LEFT JOIN Sapient_imp.".TimeslipInfo::tableName()." B ON A.TimeSlipID = B.labtech_timeslip_id WHERE B.labtech_timeslip_id IS NULL AND A.Date > '".$this->startingDate."'";
			$this->remoteRecords = $this->dbConnection->createCommand($sqlQuery)->queryAll();
			}
		catch(Exception $e)
			{
				$this->progress .= "Error in fetching Foreign Data, Error: ".$e->getMessage();	
			}
		$this->progress .= "Found ".count($this->remoteRecords)." Labtech Records without local object created\n";
		

		$clientList = Client::getClientList(Client::LABTECH_KEY);
		$timeCategories = array_flip(Lookup::items("TimeCategory"));

		
		
		
		$this->progress .= "Creating Local Data copies of Labtech Timeslips \n";
		foreach($this->remoteRecords as $remoteRecord)
			{
				
			
			//Check the data is valid
			if(!array_key_exists($remoteRecord['ClientID'], $clientList))
				{
				$this->progress .= "Unable to locate client for ticket ".$remoteRecord['TicketID']."\n";
				$this->errorCount++;
				
				}
			else{
				$newTimeslipInfo = new TimeslipInfo();
				$newTimeslipInfo->labtech_timeslip_id = $remoteRecord['TimeSlipID'];
				$newTimeslipInfo->labtech_ticket_id = $remoteRecord['TicketID'];
				
				$ticketInfo =  TicketInfo::getTicketInfo($remoteRecord['TicketID']);
				
			
				
				
				if(!isset($ticketInfo))
					{
					$this->progress .= "Unable to locate Ticket Info for Timeslip for timeslip id: .".$remoteRecord['TimeSlipID']." and ticketID: ".$remoteRecord['TicketID']."\n";
					$this->progress .= "Creating the Ticket Info\n";
					
					
					$client = Client::find()->where([Client::LABTECH_KEY => $remoteRecord['ClientID']])->one();
					$ticket = LabtechTickets::find()->where(['TicketID' => $remoteRecord['TicketID']])->one();
					
				
					$ticketInfo = new TicketInfo();
					$ticketInfo->labtech_ticket_id = $remoteRecord['TicketID'];
					$ticketInfo->imp_status = TicketInfo::DEFAULT_STATUS;
					$ticketInfo->client_id = $client->id;
					$ticketInfo->default_charge_rate_id = $client->getDefaultChargeRate($ticket->ComputerID);
					$ticketInfo->default_billing_account_id = $client->agreement->default_account_id;
					$ticketInfo->save();
					if(!$ticketInfo->save())
						{
							$errors = $ticketInfo->getErrors();
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
						$this->progress .= "New Ticket Info Object Created\n";
						}
					}
				$newTimeslipInfo->ticket_info_id = $ticketInfo->id;
				$newTimeslipInfo->billed_time_hours = $remoteRecord['Hours'];
				$newTimeslipInfo->billed_time_mins = $remoteRecord['Mins'];
					
					
				//process the Timeslip charge rates overide from labtech
				if($remoteRecord['Category'] == 0 || $timeCategories['Agreement Default'] == $remoteRecord['Category'] )
					{
					$newTimeslipInfo->charge_rate_id = $ticketInfo->default_charge_rate_id;	
					$newTimeslipInfo->billing_account_id = $ticketInfo->default_billing_account_id;
					}
				elseif($timeCategories['Agreement Project'] == $remoteRecord['Category'])
					{
					$newTimeslipInfo->charge_rate_id = $ticketInfo->client->agreement->default_project_rate_bh_id;
					$newTimeslipInfo->billing_account_id = $ticketInfo->client->agreement->default_project_account_id;
					}
				elseif($timeCategories['Not Billable'] == $remoteRecord['Category'])
					{
					$newTimeslipInfo->charge_rate_id = ChargeRates::getNotBillableCode();
					$newTimeslipInfo->billing_account_id = Accounts::getNotBilledAccountID();
					}
				elseif($timeCategories['Agreement Default After Hours'] == $remoteRecord['Category'])
					{
					$newTimeslipInfo->charge_rate_id = $ticketInfo->client->agreement->default_AH_rate_id;
					$newTimeslipInfo->billing_account_id = $ticketInfo->default_billing_account_id;
					}
				elseif($timeCategories['Agreement Project After Hours'] == $remoteRecord['Category'])
					{
					$newTimeslipInfo->charge_rate_id = $ticketInfo->client->agreement->default_prohect_rate_ah_id;
					$newTimeslipInfo->billing_account_id = $ticketInfo->client->agreement->default_project_account_id;
					}
				else{
					$newTimeslipInfo->charge_rate_id = $ticketInfo->default_charge_rate_id;	
					$newTimeslipInfo->billing_account_id = $ticketInfo->default_billing_account_id;
					}
				
				$newTimeslipInfo->billing_account_id = $ticketInfo->default_billing_account_id;
				if(!$newTimeslipInfo->save())
					{
					$errors = $newTimeslipInfo->getErrors();
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


		$this->progress .= $this->localRecordsUpdated." Local Records Updated\n";
		$this->progress .= $this->errorCount." Errors encounted during Sync\n";
		if($this->errorCount > 0){
			$syncRelationship->syncSuccessfull(SyncRelationships::STATUS_WARNING, "Sync completed with some errors");
			}
		else{
			$syncRelationship->syncSuccessfull(SyncRelationships::STATUS_SUCCESS, "Sync completed without any errors");
			}
		
	}
	
	

}


?>
