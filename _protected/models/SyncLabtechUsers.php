<?php
use app\models\User;
use yii\helpers\ArrayHelper;
use app\rbac\models\Role;


require_once("SyncModelBase.php");

class syncLabtechUsers extends syncModelBase

{
	
	
	var $default_role = "Technician";
	
	var $dataIndex = array("imp" => "labtech_id", "remote" => "UserID");
	
	var $databaseName = "labtech";
	var $databaseTable = "users";
	var $remoteUpdateField = "Last_date";
	var $localUpdateField = "updated_at";
	
	//imp => remote
	var $fieldMapping = [
		"username" => "Name",
		"email" => "Email",
		"firstname" => "Name",
		];	
		
	var $ignoreLabtechAccount = 
		[
		"root",
		"User",
		"labtechsupport",
		"Monitor Email",
		];
		
	var $dbConnection;
	
	
	function executeSync($syncRelationship)
	{
		
		
		
		$this->progress = "Attempting Sync Labtech User Information with IMP\n";
		$this->dbConnection = $this->connectDatabase($syncRelationship, $this->databaseName, $this->databaseTable);
		if(is_string($this->dbConnection))
			{
			$this->progress .= $this->dbConnection;
			return;
			}
		$this->progress .= "   ....Connected \n";
		
		/**
		* 
		* Fetching the remote data records are indexed by the labtech_id property
		* 
		*/
		$this->progress .= "Fetching remote records to sync \n";			
		try{
			$sqlQuery = "Select * From ".$this->databaseTable;
			$remoteResults = $this->dbConnection->createCommand($sqlQuery)->queryAll();
			$this->remoteRecords = ArrayHelper::index($remoteResults, $this->dataIndex['remote']);	
			}
		catch(Exception $e)
		{
			$this->progress .=  "Error in fetching Foreign Data, Error: ".$e->getMessage();	
			return;
		}	
		$this->progress .= "  ".count($this->remoteRecords)." Records Retrieved from Remote Source\n";
		
		/**
		* 
		* go through ans check that for each labtech record there is a corresponding imp user, if not create it.
		* also check that the username in labtech matches the username in imp and the email addresses match
		* 
		*/
		
		$impUsers = ArrayHelper::index(User::find()->all(), $this->dataIndex['imp']);
		foreach($this->remoteRecords as $remoteRecord)
			{
				
			//If there is no user then create an Imp user account
			if(array_search($remoteRecord['Name'], $this->ignoreLabtechAccount) === false)
				{
				if(!array_key_exists($remoteRecord[$this->dataIndex['remote']], $impUsers))
					{
					$this->createImpUser($remoteRecord);
					}
			
				//User accoutn found check the details and sync
			//	else{
			//		$remotePhpDate =  strtotime( $remoteRecord[$this->remoteUpdateField] );
			//		$localUpdateDate = $this->localUpdateField;
			//		$this->progress .= "Comparing update fields Imp: ".date("d M Y, H:i", $remotePhpDate)." ".$remotePhpDate." To ".date("d M Y, H:i", $impUsers[$remoteRecord['UserID']]->$localUpdateDate)."\n";
			//		}
				}
			}
		$this->progress .= "Local record update completed\n";
		
		

	}
	
	
	public function createImpUser($remoteRecord)
	{
		$this->progress .= "Creating local user, username: ".$remoteRecord['Name']."\n";
		$newUser = new User();
		$newUser->status = User::STATUS_ACTIVE;
		
		$localField = $this->dataIndex['imp'];
		//$remoteField = $this->dataIndex['remote'];
		
		$newUser->$localField  = $remoteRecord[$this->dataIndex['remote']];
		foreach($this->fieldMapping as $impKey => $labtechKey)
			{
			$newUser->$impKey = $remoteRecord[$labtechKey];
			}
		if(!$newUser->save())
			{
			$this->displaySaveErrors(($newUser->getErrors()));
			}
			
		$userRole = new Role();
		$userRole->user_id = $newUser->id;
		$userRole->item_name = $this->default_role;
		if(!$userRole->save())
			{
			$this->displaySaveErrors($userRole->getErrors());
			}
	}
	

}


?>