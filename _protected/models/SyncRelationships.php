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
            'endPoint' => 'End Point',
            'username' => 'Username',
            'password' => 'Password',
            'frequenyMin' => 'Frequeny Min',
            'lastSync' => 'Last Sync',
            'LastStatus' => 'Last Status',
            'LastStatusData' => 'Last Status Data',
        ];
    }
}
