<?php
use app\models\Syncrelationships;
use app\models\Client;
/*
* Class SyncModelBase class
* Description: This model provides all of the common functionality for all of the sync models
* each different sync relationship will need to have a seperate class that inherits with model.
*/


Class syncModelBase{
	
	
	
	//datamapping variable should be an array 
	//   "impModelFieldName" => "ForeignFieldName" - simply 1-to-1 datatranslation
	//	"impModelFieldName" => array("name" => "ForeignFieldName", "callBack" => "transformationFunctionName")
	public  $dataFromImpMapping;
	
	// dataToImpMapping -> is an array of keys from the data array into implements
	// array("foreignFieldName" => "impFieldName") - basic one to one mapping
	// array("foreignFieldNAme" =>  array("name" => "impFieldName", "callback" =>transformationFunctionName))
	public 	$dataToImpMapping ;
	
	//DataIndex -> How the two enties are related array("imp" => "ImpFieldName", "foreign" => foriegnFieldName)
	public $dataIndex;
	
	
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
			return $this->syncDatabase($syncRelationship);
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
	function syncDatabase($syncRelationship)
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
		
		//Of this section will grab all the records from the foreign source that have changed since the last sync
		//was carried out.
		$returnText .= "\n\nFetching Changes in Foreign Data\n";				
		$foreignChanges = $this->fetchForeignChanges($syncRelationship);
		if(is_string($foreignChanges))
			{
			$returnText .= $foreignChanges;
			}
		else
			{	
			$returnText .= "    ".count($foreignChanges)." Foreign record(s) changed since last sync\n";
			foreach($foreignChanges as $record)
				{
				$returnText .= "      ".$record['Name']."\n";
				}
			}
		
		
		
		
		
		//OK from this point we have two arrays, the array of imp records that have changed since the last syncLabtechClient
		//and the array of records of the foreign datasource that have changed since the last sync was carried out.
		//print_r($foreignChanges);
		//$updatedRecords -> Imp models
		//$foreignChanges -> Foreigns changes in an assoicated array of data. not index by id but by number
		
		
		
		$returnText .= "\n\nSync Completed at ".date("H:m d-M-Y")."\n";
		//$syncRelationship->lastSync = date("Y-m-d H:i:s");
		$syncRelationship->save();
		return $returnText;

		
		
	}



	/*
	Function: copyFromImp
	Description: Takes the given array of changes to IMP and copies to the foreign datasource
	input: impModels -> an array of imp models that have changed since the last sync
	*/
	function copyFromImp($impModels)
	{
	
		foreach($impModels as $impModel)
			{
			$this->transferToForiegn($impModel;)
			}
	}

	/*
	Function: copyToImp
	Descitpion: Takes the associated array of data from the Foreign source and copies it into Imp database
	Input: foreignDataArray
	*/
	function copyToImp($foreignDataArray)
	{
		
	}


	/*
	Function: CheckDuplicates
	Description: This function runs through and check for duplicated in the two arrays
				If any duplicated are found then the latest entry is copied over the other entry
	input: The two dataarrays, one containing the imp models and the other containing the foriegn DataColumn
	output: none
	*/
	function checkDuplicates($impModels, $foreignDataArray)
	{
		
	}
	
	
	


	//Place holder only, this needs to be defined in the child object
	function connectDatabase()
	{
	}


	//place holder only, this needs to defined in the child object
	function fetchForeignChanges()
	{
		
	}
	
	
	
	
	
}





?>