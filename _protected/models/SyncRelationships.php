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
		
		
		
		
	}
    
    
    public function syncLabtechClient()
    {
		
		$targetModelName = 'LabtechClient';
		$internalModelName = 'client';
		$foreignKey = 'IntegrationID1';
		
		
		//Foreign modelName => internalModel
		$fieldMappings = array
		([
			'ID' => 'IntgegrationID1'
			'Name' => 'name',
			'Address1' => 'address',
			'City' => 'city',
			'State' => 'state',
			'Zip' => 'postcode',
			
		]);
		
	}
    
    
}
