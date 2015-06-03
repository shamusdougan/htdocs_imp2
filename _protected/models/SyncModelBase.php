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
	
	
	/*
	Function: syncDatabase
	Description: Takes the db Connection obejcts and performs the sync, this is designed to be run from the child object that 
	input: connection -> the yii connction object for the foriegn database
		$syncRelationship -> the given sync relationship object. This object stores the information for the last sync etc
	
	*/
	function syncDatabase($connection, $syncRelationship)
	{
		//query the local database for any records that have changed since the last sync
		
		//$results = $connection->createCommand("Select * From clients")->queryAll();
		
		//No sync has been done yet start the process off
		if($syncRelationship->lastSync == "")
		{
			$syncRelationship->lastSync = date("Y-m-d H:i:s", mktime(0,0,0,1,1,1970));
			$syncRelationship->save();
		}
		
		
		//	fetch the imp records that have changed since the last sync
		
 		$results = Client::find()
 			->where("last_change > '".$syncRelationship->lastSync."'")
 			->all(); 
		print_r($results);
		
		
		
		
		// fetch the foreign records that have changed since the last sync was performed
		$results = $connection->createCommand("Select * From clients")->queryAll();


		return $syncRelationship->lastSync;

		
		
	}
	
}





?>