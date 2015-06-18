<?php

require_once("SyncModelBase.php");

class syncLabtechClient extends syncModelBase

{
	
	var $dataMapping = [
		"FK1" => "id",
	
	
	
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
	
	
	function fetchDataArray()
	{
		
	}
	
	
	
}


?>