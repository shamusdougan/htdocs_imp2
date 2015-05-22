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
            [['impModelName', 'endPointName', 'endPointType', 'endPointDBServer', 'endPointDBName', 'endPointDBTable', 'endPointUser', 'endPointPassword', 'syncModelName', 'endPointFilePath', 'endPointBaseURL'], 'required'],
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
            'endPointType' => 'End Point Type',
            'endPointDBServer' => 'End Point Dbserver',
            'endPointDBName' => 'End Point Dbname',
            'endPointDBTable' => 'End Point Dbtable',
            'endPointUser' => 'End Point User',
            'endPointPassword' => 'End Point Password',
            'syncModelName' => 'Sync Model Name',
            'frequenyMin' => 'Frequeny Min',
            'lastSync' => 'Last Sync',
            'LastStatus' => 'Last Status',
            'LastStatusData' => 'Last Status Data',
            'endPointFilePath' => 'End Point File Path',
            'endPointBaseURL' => 'End Point Base Url',
        ];
    }
}
