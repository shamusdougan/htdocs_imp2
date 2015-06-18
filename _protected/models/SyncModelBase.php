<?php
use app\models\Syncrelationships;
use app\models\Client;
/*
* Class SyncModelBase class
* Description: This model provides all of the common functionality for all of the sync models
* each different sync relationship will need to have a seperate class that inherits with model.
*/


Class syncModelBase{
	
	
	
	public $impModelName;
	
	//datamapping variable should be an array 
	//   "impModelFieldName" => "ForeignFieldName" - simply 1-to-1 datatranslation
	//	"impModelFieldName" => array("name" => "ForeignFieldName", "callBack" => "transformationFunctionName")
	public $dataMapping;
	
	
	/*
	Function ExecuteSync
	Description: This function executes the sync between the two data sources
	*/
	function executeSync($syncRelationship)
	{
		if(is_null($syncRelationship) || $syncRelationship == "")
		{
			die("Invalid Sync Relationship object being used");
		}
		
		if($syncRelationship->endPointType == Syncrelationships::ENDPOINTTYPE_DATABASE)
		{
			$dataConnection = $this->connectDatabase($syncRelationship);
			if(is_string($dataConnection))
				{
				return $dataConnection;
				}
			else{
				return $this->syncDatabase($dataConnection, $syncRelationship);
			}
		}
		elseif($syncRelationship->endPointType == Syncrelationships::ENDPOINTTYPE_WEB)
		{
			return "Web url sync";
		}
		elseif($syncRelationship->endPointType == Syncrelationships::ENDPOINTTPYE_FILE)
		{
			return "File Type Sync";
		}
		
		
	}
	
	
	
	/*
	Function: syncDatabase
	Description: Takes the db Connection obejcts and performs the sync, this is designed to be run from the child object that 
	input: connection -> the yii connction object for the foriegn database
		$syncRelationship -> the given sync relationship object. This object stores the information for the last sync etc
	
	*/
	function syncDatabase($connection, $syncRelationship)
	{
		
		//No sync has been done yet start the process off
		if($syncRelationship->lastSync == "")
		{
			$syncRelationship->lastSync = date("Y-m-d H:i:s", mktime(0,0,0,1,1,1970));
			$syncRelationship->save();
		}
		
		$returnText = "Attempting Sync between IMP (me) and ".$syncRelationship->endPointName."\n";
		$returnText .= "\nSyncing Imp:".$syncRelationship->impModelName." and ".$syncRelationship->endPointName.": ".$syncRelationship->endPointDBTable."\n";
		
		
		
		//	fetch the imp records that have changed since the last sync
		$updatedRecords = Client::find()
 			->where("last_change > '".$syncRelationship->lastSync."'")
 			->all(); 
		
		$returnText .= "    ".count($updatedRecords)." imp record(s) changed since last sync\n";
		
		
		foreach($updatedRecords as $record)
		{
			$returnText .= "      ".$record->name." changed\n";
		}
		
		
/*		//Fetch the Foreign records that have changed since the last syncLabtechClient
		$updatedForeignRecords = $connection->createCommand("Select * From ".$syncRelationship->endPointDBTable." WHERE ")->queryAll();
		$returnText .= "    ".count($updatedForeignRecords)." Foreign record(s) changed since last sync\n";
		
		
		foreach($updatedForeignRecords as $record)
				{
					$returnText .= "      ".$record['Name']."\n";
				}
				
*/				
		
		
		$returnText .= "\n\nSync Completed at ".date("H:m d-M-Y")."\n";
		$syncRelationship->lastSync = date("Y-m-d H:i:s");
		$syncRelationship->save();
		return $returnText;

		
		
	}


	//Place holder only, this needs to be defined in the child object
	function connectDatabase()
	{
	}


	//place holder only, this needs to defined in the child object
	function fetchDataArray()
	{
		
	}
	
}





?>