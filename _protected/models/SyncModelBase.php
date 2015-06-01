<?php
use app\models\Syncrelationships;
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
			return "Database Sync";
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
	
	
}





?>