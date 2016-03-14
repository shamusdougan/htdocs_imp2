<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "syncrelationships".
 *
 * @property integer $index
 * @property string $description
 * @property string $syncModelName
 * @property string $endPoint
 * @property string $username
 * @property string $password
 * @property integer $frequenyMin
 * @property string $lastSync
 * @property integer $LastStatus
 * @property string $LastStatusData
 */
class SyncRelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
     const STATUS_SUCCESS = 1;
     const STATUS_FAILED = 2;
     const STATUS_WARNING = 3;
     
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
            [['description', 'syncModelName', 'frequenyMin'], 'required'],
            [['frequenyMin', 'LastStatus'], 'integer'],
            [['lastSync'], 'safe'],
            [['description', 'syncModelName'], 'string', 'max' => 200],
            [['endPoint', 'username', 'password'], 'string', 'max' => 50],
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
            'description' => 'Description',
            'syncModelName' => 'Sync Model Name',
            'endPoint' => 'Connect To',
            'username' => 'Username',
            'password' => 'Password',
            'frequenyMin' => 'Sync Frequeny Min',
            'lastSync' => 'Last Sync',
            'LastStatus' => 'Last Status',
            'LastStatusData' => 'Last Status Data',
        ];
    }
    
    /**
	* 	function: getLastSync
	* 
	* @return
	*/
    public function getLastSync()
    {
	if($this->lastSync == "")
		{
		$this->lastSync = date("Y-m-d H:i:s", mktime(0,0,0,1,1,1970));
		$this->save();
		}
		
	return $this->lastSync;
	}
	
	
	public function syncSuccessfull($status = SyncRelationships::STATUS_SUCCESS, $message = null)
	{
		$this->lastSync = time();
		$this->LastStatus = $status;
		$this->LastStatusData = $message;
		if(!$this->save())
			{
			die("Unable to save sync data back to thedatabase");
			}
	}
}
