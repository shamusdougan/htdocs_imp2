<?php
use app\models\Syncrelationships;
use app\models\Client;
/*
* Class SyncModelBase class
* Description: This model provides all of the common functionality for all of the sync models
* each different sync relationship will need to have a seperate class that inherits with model.
*/


Class syncModelBase{
	
	const DUALSYNC = 1;
	const LOCAL2REMOTE_ONLY = 2;
	const REMOTE2LOCAL_ONLY = 3;
	const LOCAL_OVERIDE_REMOTE = 4;
	const REMOTE_OVERRIDE_LOCAL = 5;
	
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
	
	
	//Progress -> the running progress of the sync. during the sync process the status of each step should be written to $this-Progress
	public $progress;
	public $syncType;
	
	public $localRecords = array();
	public $remoteRecords = array();
	
	
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
		
		$this->progress = "Attempting Sync between IMP (me) and ".$syncRelationship->endPointName."\n";
		$this->progress .= "\nSyncing Imp:".$syncRelationship->impModelName." and ".$syncRelationship->endPointName.": ".$syncRelationship->endPointDBTable."\n";
		
		
		//Initiate the connect to the remote database
		$this->progress .= "Connecting to Remote Database...\n";
		$dbConnection = $this->connectDatabase($syncRelationship);
		if(is_string($dbConnection))
			{
			$this->progress .= $dbConnection."\n";
			$this->progress .= "Sync Failed at ".date(" h:i d/m/Y")."\n";	
			return;
			}
		$this->progress .= "   ....Connected \n";
		
		
		//Grab the remote data if required by the sync client type
		if($this->syncType == syncModelBase::DUALSYNC || $this->syncType == syncModelBase::REMOTE_OVERRIDE_LOCAL || $this->syncType == syncModelBase::REMOTE2LOCAL_ONLY )
			{
			$this->progress .= "Fetching remote records changed since ".$syncRelationship->lastSync."\n";				
			$this->remoteRecords = $this->getRemoteRecordsChangedSince($syncRelationship, $dbConnection);
			if(is_string($this->remoteRecords))
				{
				$this->progress .= 	$this->remoteRecords."\n";
				return;		
				}
			$this->progress .= "  ".count($this->remoteRecords)." Records Retrieved from Remote Source\n";
			}
		
		//Grab the local Data if required by the sync client sync type		
		if($this->syncType == syncModelBase::DUALSYNC || $this->syncType == syncModelBase::LOCAL2REMOTE_ONLY || $this->syncType == syncModelBase::LOCAL_OVERIDE_REMOTE )
			{
			$this->progress .= "Fetching imp records changed since ".$syncRelationship->lastSync."\n";
			$this->localRecords = $this->getLocalRecordsChangedSince($syncRelationship, $dbConnection);
			if(is_string($this->localRecords))
				{
				$this->progress .= 	$this->localRecords."\n";
				return;		
				}
			$this->progress .= "  ".count($this->localRecords)." Records Retrieved from Imp\n";
			}	
		
		
		
		//OK from this point we have two arrays, the array of imp records that have changed since the last syncLabtechClient
		//and the array of records of the foreign datasource that have changed since the last sync was carried out.
		//$localRecords -> Imp models as an array
		//$remoteRecords -> Foreigns changes in an assoicated array of data. not index by id but by number
		
		//check for any clicts if the sync is twoway, which ever record was updated last is seen to be the correct record.
		if($this->syncType == syncModelBase::DUALSYNC)
			{
			$this->progress .= "checking for and record conflicts in both sources... the newest record changed will over right the older\n";
			$this->checkConflicts($this->localRecords, $this->remoteRecords);	
			}
		



		
		
		
		$this->progress .= "\n\nSync Completed at ".date("H:m d-M-Y")."\n";
		//$syncRelationship->lastSync = date("Y-m-d H:i:s");
		$syncRelationship->save();
		return;

		
		
	}



	/*
	Function connectDatabase
	Descitpion: takes the syncRelationship object and connected to the database
	inputs: syncRelationship Object -> see syncRelationship Model
	outputs: either the database connections object or the error message to be returned, if the database to be connected to isn't an sql database
			override on the child class.
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
	
	
	


	/*
	Function: copyFromImp
	Description: Takes the given array of changes to IMP and copies to the foreign datasource
	input: impModels -> an array of imp models that have changed since the last sync
	*/
	function copyFromImp($impModels)
	{
	
		foreach($impModels as $impModel)
			{
			$this->transferToForiegn($impModel);
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
	
	
	




	//place holder only, this needs to defined in the child object
	function fetchForeignChanges()
	{
		
	}
	
	
	
	
	
}





?>