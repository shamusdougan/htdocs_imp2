<?
namespace app\models;
use Yii;


class sync
{
	
	
	public $targetModelName;
	public $internalModelName;
	public $foreignKey;
	
	 public function executeSync()
	 {
	 	if($this->targetModelName == "" || $this->internalModelName == "" || $this->foreignKey == "")
		{
			return "Missing Sync Data for executing the Sync";
		}
		else
		{
			$foreightObjects = $this->targetModelName::find()->All();
			$returnString = "Executing Sync between foreign:".$this->targetModelName." and this".$this->impModelName."\n";
			$returnString .= "Found ".count($foreightObjects)." Records in database\n";
			
		/*	foreach($LabtechClients as $labtechClient)
			{
				$impClient = Client::find()->where(['IntegrationID1' => $labtechClient->ClientID])->one();
				if($impClient != null)
				{
					$returnString .= "Found record checking fields are upto date\n";
				}
				else{
					$returnString .= "Cant find corresponding IMP record for ".$labtechClient->Name." Creating IMP Record\n";
				}
			}*/
			
			
			$internalObjects = $internalModelName::find()->all();
			$returnString .= "Found ".count($internalObjects)." Clients in impDatabase database \n";
			
			
			return $returnString;
		}
		
	 }
	
	
	
	
	
	
	
	
}
?>