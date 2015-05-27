<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "syncrelationships".
 *
 * @property integer $index
 * @property string $impModelName
 * @property string $endPointName
 * @property integer $endPointType
 * @property string $endPointDBServer
 * @property string $endPointDBName
 * @property string $endPointDBTable
 * @property string $endPointUser
 * @property string $endPointPassword
 * @property string $syncModelName
 * @property integer $frequenyMin
 * @property string $lastSync
 * @property integer $LastStatus
 * @property string $LastStatusData
 * @property string $endPointFilePath
 * @property string $endPointBaseURL
 */
class Syncrelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     const ENDPOINTTYPE_DATABASE=1;
 	 const ENDPOINTTYPE_WEB=2;
	 const ENDPOINTTPYE_FILE=3;
     
     
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
            [['impModelName', 'endPointName', 'endPointType', 'syncModelName', 'frequenyMin'], 'required'],
            [['endPointType', 'frequenyMin', 'LastStatus'], 'integer'],
            [['lastSync'], 'safe'],
            [['impModelName', 'endPointName', 'endPointDBServer', 'endPointDBName', 'endPointDBTable', 'endPointUser', 'endPointPassword', 'syncModelName', 'endPointFilePath'], 'string', 'max' => 200],
            [['LastStatusData', 'endPointBaseURL'], 'string', 'max' => 500]
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
            'endPointType' => 'Sync Type',
            'endPointDBServer' => 'DB Server',
            'endPointDBName' => 'DB Name',
            'endPointDBTable' => 'DB Table',
            'endPointUser' => 'User',
            'endPointPassword' => 'Password',
            'syncModelName' => 'Sync Model',
            'frequenyMin' => 'Freq (Min)',
            'lastSync' => 'Last Sync',
            'LastStatus' => 'Last Status',
            'LastStatusData' => 'Last Status Data',
            'endPointFilePath' => 'File Path',
            'endPointBaseURL' => 'Url',
        ];
    }
}
