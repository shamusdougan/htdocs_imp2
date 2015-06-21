<?php

require_once("SyncModelBase.php");

class syncLabtechClient extends syncModelBase

{
	
	
	var $dataIndex = array("imp" => "FK1", "foriegn" => "ClientID");
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
	Function connectDatabase
	Descitpion: takes the syncRelationship object and connected to the database
	inputs: syncRelationship Object -> see syncRelationship Model
	outputs: either the database connections object or the error message to be returned
	*/
	function connectDatabase($syncRelationship)
	{
		$dsn = "mysql:host=".$syncRelationship->endPointDBServer.";dbname=".$syncRelationship->endPointDBName;
		$connection = new \yii\db\Connection([
		    'dsn' => $dsn,
		    'username' => $syncRelationship->endPointUser,
		    'password' => $syncRelationship->endPointPassword,
		]);
	
	try{
		$connection->open();	
		}
	catch(Exception $e)
		{
			return "Unable to connect to Database: ".$dsn." using: ".$syncRelationship->endPointUser."\nError Message Returned: ".$e->getMessage();
		}
	
	return $connection;
	
	}
	
	
	function fetchForeignChanges($syncRelationship)
	{
	
	
		$connection = $this->connectDatabase($syncRelationship);
		
		try{
			$updatedForeignRecords = $connection->createCommand("Select * From ".$syncRelationship->endPointDBTable." WHERE Last_Date > '".$syncRelationship->lastSync."'")->queryAll();
			}
		catch(Exception $e)
		{
			return "Error in fetching Foreign Data, Error: ".$e->getMessage();	
		}
	
		return $updatedForeignRecords;
		
	}
	
	function transferToForiegn($impModel)
	{
		
	}
	
}


?>