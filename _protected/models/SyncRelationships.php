<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "syncrelationships".
 *
 * @property integer $index
 * @property string $impModelName
 * @property string $endPointName
 * @property string $endPointDBName
 * @property string $endPointDBTable
 * @property string $endPointDBUser
 * @property string $endPointDBPassword
 * @property string $syncFunctionName
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
            [['impModelName', 'endPointName', 'endPointDBName', 'endPointDBTable', 'endPointDBUser', 'endPointDBPassword', 'syncFunctionName'], 'required'],
            [['frequenyMin', 'LastStatus'], 'integer'],
            [['lastSync'], 'safe'],
            [['impModelName', 'endPointName', 'endPointDBName', 'endPointDBTable', 'endPointDBUser', 'endPointDBPassword', 'syncFunctionName'], 'string', 'max' => 200],
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
            'endPointDBName' => 'End Point Dbname',
            'endPointDBTable' => 'End Point Dbtable',
            'endPointDBUser' => 'End Point Dbuser',
            'endPointDBPassword' => 'End Point Dbpassword',
            'syncFunctionName' => 'Sync Function Name',
            'frequenyMin' => 'Frequeny Min',
            'lastSync' => 'Last Sync',
            'LastStatus' => 'Last Status',
            'LastStatusData' => 'Last Status Data',
        ];
    }
}
