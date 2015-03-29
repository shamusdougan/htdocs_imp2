<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "syncrelationships".
 *
 * @property integer $index
 * @property string $impModelName
 * @property string $endPointName
 * @property string $endPointDataType
 * @property integer $frequenyMin
 * @property string $lastSync
 * @property integer $LastStatus
 * @property string $LastStatusData
 */
class Syncrelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'syncrelationships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['impModelName', 'endPointName', 'endPointDataType'], 'required'],
            [['frequenyMin', 'LastStatus'], 'integer'],
            [['lastSync'], 'safe'],
            [['impModelName', 'endPointName', 'endPointDataType'], 'string', 'max' => 200],
            [['LastStatusData'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'index' => 'Index',
            'impModelName' => 'Imp Model Name',
            'endPointName' => 'End Point Name',
            'endPointDataType' => 'End Point Data Type',
            'frequenyMin' => 'Frequeny Min',
            'lastSync' => 'Last Sync',
            'LastStatus' => 'Last Status',
            'LastStatusData' => 'Last Status Data',
        ];
    }
    
    
    public function executeSync()
    {
		if($this->endPointName == "" || $this->endPointDataType == "" || $this->impModelName == "")
		{
			return "Missing Sync Data for executing the Sync";
		}
		else
		{
			
			$LabtechClients = LabtechClient::find()->All();
			$returnString = "Executing Sync between ".$this->endPointName.": ".$this->endPointDataType." and ".$this->impModelName."<br>";
			$returnString .= "Found ".count($LabtechClients)." Clients in Labtech database <br>";
			
			foreach($LabtechClients as $labtechClient)
			{
				$impClient = Client::find()->where(['$IntegrationID1' => $labtechClient->ClientID]);
				if($impClient != null)
				{
					print_r(count($impClient));
					$returnString .= "Found record checking fields are upto date<br>";
				}
				else{
					$returnString .= "Cant find corresponding IMP record for ".$labtechClient->name." Creating IMP Record<br>";
				}
			}
			
			$returnString .= "Found ".count($impClients)." Clients in impDatabase database <br>";
			
			
			return $returnString;
		}
		
		
		
		
	}
    
}
