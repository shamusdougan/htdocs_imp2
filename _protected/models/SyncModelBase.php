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
	
	const SYNC_SUCCESS = 1;
	const SYNC_ERROR = 2;
	
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
	
	public $recordConflicts = 0;
	public $errorCount = 0;
	public $localRecordsUpdated = 0;
	public $localRecordsCreated = 0;
	public $remoteRecordsUpdated = 0;
	public $remoteRecordsCreated = 0;
	
	
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
			return $this->syncFile($syncRelationship);
		}
		elseif($syncRelationship->endPointType == Syncrelationships::ENDPOINTTYPE_DBSPAN)
		{
			return $this->syncDatabaseSpan($syncRelationship);
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
		$this->dbConnection = $this->connectDatabase($syncRelationship);
		if(is_string($this->dbConnection))
			{
			$this->progress .= $this->dbConnection."\n";
			$this->progress .= "Sync Failed at ".date(" h:i d/m/Y")."\n";
			
			$syncRelationship->LastStatus = syncModelBase::SYNC_ERROR;
			$syncRelationship->save();
			
			return;
			}
		$this->progress .= "   ....Connected \n";
		
		
		//Grab the remote data if required by the sync client type
		if($this->syncType == syncModelBase::DUALSYNC || $this->syncType == syncModelBase::REMOTE_OVERRIDE_LOCAL || $this->syncType == syncModelBase::REMOTE2LOCAL_ONLY )
			{
			$this->progress .= "Fetching remote records changed since ".$syncRelationship->lastSync."\n";				
			$this->remoteRecords = $this->getRemoteRecordsChangedSince($syncRelationship);
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
			$this->localRecords = $this->getLocalRecordsChangedSince($syncRelationship);
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
		
		//check for any conflicts if the sync is twoway, which ever record was updated last is seen to be the correct record.
		if($this->syncType == syncModelBase::DUALSYNC)
			{
			$this->progress .= "checking for and record conflicts in both sources... the newest record changed will over right the older\n";
			$this->checkConflicts($this->localRecords, $this->remoteRecords);	
			}
		
		//transfer the data from remote source to local
		if($this->syncType == syncModelBase::DUALSYNC || $this->syncType == syncModelBase::LOCAL_OVERIDE_REMOTE || $this->syncType == syncModelBase::REMOTE_OVERRIDE_LOCAL)
			{
			$this->progress .= "transfering remote records to local database \n";
		
			$this->transferFromRemote();
			$this->progress .= "    Created ".$this->localRecordsCreated." new Records\n";
			$this->progress .= "    Updated ".$this->localRecordsUpdated." Records\n";
			}
			
		if($this->syncType == syncModelBase::DUALSYNC)
			{
			$this->progress .= "Transferring data to the remote database\n";
			$this->transferToRemote($syncRelationship);	
			}


		
		
		$this->progress .= "\n\nSync Completed at ".date("H:m d-M-Y")."\n";
		$syncRelationship->lastSync = date("Y-m-d H:i:s");
		$syncRelationship->LastStatus = syncModelBase::SYNC_SUCCESS;
		$syncRelationship->save();
		return;

		
		
	}



/*
	Function: syncDatabaseSpan
	Description: Takes the db Connection obejcts and performs the sync, this is designed to be run from the child object that 
	input: connection -> the yii connction object for the foriegn database
		$syncRelationship -> the given sync relationship object. This kind of sync simply compares the join of the two tables,
							 if rows dont appear in the imp database it simply creates them using the predefined defaults
	
	*/
	function syncDatabaseSpan($syncRelationship)
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
		$this->dbConnection = $this->connectDatabase($syncRelationship);
		if(is_string($this->dbConnection))
			{
			$this->progress .= $this->dbConnection."\n";
			$this->progress .= "Sync Failed at ".date(" h:i d/m/Y")."\n";
			
			$syncRelationship->LastStatus = syncModelBase::SYNC_ERROR;
			$syncRelationship->save();
			
			return;
			}
		$this->progress .= "   ....Connected \n";
		
		$this->progress .= " Fetching records in labtech that have no corresponding records in imp\n";
		$this->remoteRecords = $this->getRemoteRecords($syncRelationship);
		if(is_string($this->remoteRecords))
			{
			$this->progress .= $this->remoteRecords."\n";
			return;
			}
		
		
		
		
		$this->progress .= "\n\nSync Completed at ".date("H:m d-M-Y")."\n";
		//$syncRelationship->lastSync = date("Y-m-d H:i:s");
		//$syncRelationship->LastStatus = syncModelBase::SYNC_SUCCESS;
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
	Function: checkConflicts()
	input:
		$localRecords -> an array of local records, inrementing index
		$remoteRecords -> an array of remote records, incrementing IndexAction
	output: none
	Description: this function takes the two list and checks for any conflicts in the data records. The newest record is taken to be
				the authorative record, and the old record will be unset. */
	function checkConflicts()
	{

	//Check to make sure we have valid config and setup
	if(!isset($this->dataLastChangeFields) || !isset($this->dataLastChangeFields['imp']) || !isset($this->dataLastChangeFields['remote']))
		{
		die("datalastChangeFields not set correctly");
		}
		
	
		
	$newLocalRecords = array();
	$newRemoteRecords = array();
	$impKey = $this->dataIndex['imp'];
	$impLastchangeField = $this->dataLastChangeFields['imp'];
	$remoteKey = $this->dataIndex['remote'];
	$remoteLastchangeField = $this->dataLastChangeFields['remote'];
	
		
	if(count($this->remoteRecords) === 0 || count($this->localRecords) === 0)
		{
		$this->progress .= "No conflicts found\n";
		return;
		}
	
	
	
	//Check that the sync setup is correct
	if(!array_key_exists($remoteKey, $this->remoteRecords)){
		$this->progress .= "Invalid Foreign Key defined in SyncRealationship Model\n";
		return;
		}
		
		
		

	if(!array_key_exists($impKey, $this->localRecords))
		{
		$this->progress .= "Invalid Local Key defined in SyncRealationship Model\n";	
		return;		
		}
	
	
	
	
	//check the local records for any conflicts with the remote data
	foreach($this->localRecords as $localRecordIndex => $localRecord)
		{
		//for any instances of the foriegn key from the local data in the remote data
		$remoteRecordIndex = array_search($localRecord[$impKey], array_column($this->remoteRecords, $remoteKey));
		
		if($remoteRecordIndex !== false)
			{
			$this->progress .= "found conflicting record localRecord: ".$localRecord[$impLastchangeField]." Remote Record: ".$this->remoteRecords[$remoteRecordIndex][$remoteLastchangeField]."\n";
			$this->recordConflicts++;
			if($localRecord[$impLastchangeField] >= $this->remoteRecords[$remoteRecordIndex][$remoteLastchangeField])
				{
				$this->progress .= "   ...Using the local record\n";
				$newLocalRecords[] = $localRecord;
				}
			else{
				$this->progress .= "   ...Using the Remote Record\n";
				}
			}
		else{
			$newLocalRecords[] = $localRecord;
			}
		}
		
	
	//check for any conflicts in the remote data with the local data
	foreach($this->remoteRecords as $remoteRecordIndex => $remoteRecord)
		{
		//for any instances of the foriegn key from the local data in the remote data
		$localRecordIndex = array_search($remoteRecord[$remoteKey], array_column($this->localRecords, $impKey));	
			
		if($localRecordIndex !== false)
			{
			$this->progress .= "found conflicting record localRecord: ".$localRecord[$impLastchangeField]." Remote Record: ".$this->remoteRecords[$remoteRecordIndex][$remoteLastchangeField]."\n";
			if($localRecord[$impLastchangeField] < $this->remoteRecords[$remoteRecordIndex][$remoteLastchangeField])
				{
				$this->progress .= " .... Using remote record\n";
				$newRemoteRecords[] = $remoteRecord;
				}
			else{
				$this->progress .= " .... Using the Local Record\n";
				}
			}
		else{
			$newRemoteRecords[] = $remoteRecord;
			}	
		}
		
	$this->progress .= "   ".$this->recordConflicts." Conflicting records Found \n";
		
	$this->localRecords = $newLocalRecords;
	$this->remoteRecords = $newRemoteRecords;
		
	}
	



/**
* 
* @param undefined $Sync Files
* 
* @return
*
* Description this will push the related models out into a file at a specifed location. Inherently one way 
* 
*/
function syncFile($syncRelationship)
	{
		
		//No sync has been done yet start the process off
		if($syncRelationship->lastSync == "")
		{
			$syncRelationship->lastSync = date("Y-m-d H:i:s", mktime(0,0,0,1,1,1970));
			$syncRelationship->save();
		}
		
		$this->progress = "Attempting Sync between IMP (me) and ".$syncRelationship->endPointName."\n";
		$this->progress .= "\nSyncing Imp:".$syncRelationship->impModelName." and target file ".$syncRelationship->endPointFilePath."\n";
		
		
		//Initiate the connect to the remote database
		$this->progress .= "Connecting to File Location...\n";
		
		
		try{
			$this->fileHandle = fopen($syncRelationship->endPointFilePath, 'w');
			}
		catch(Exception $e)
			{
			$this->progress .= "   .... unable to open file location\n";
			$this->progress .= "   .... ".$e->getMessage();
			}
		
		$this->localRecords = $this->getLocalRecords();
		

		$this->progress .= "Transferring data to the remote filelocation\n";
		$this->transferToRemote($syncRelationship);	

		$this->progress .= "\n\nSync Completed at ".date("H:m d-M-Y")."\n";
		$syncRelationship->lastSync = date("Y-m-d H:i:s");
		$syncRelationship->LastStatus = syncModelBase::SYNC_SUCCESS;
		$syncRelationship->save();
	
	}
	
}





?>