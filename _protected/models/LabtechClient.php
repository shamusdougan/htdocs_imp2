<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $ClientID
 * @property string $Name
 * @property string $Firstname
 * @property string $LastName
 * @property string $Company
 * @property string $Address1
 * @property string $Address2
 * @property string $City
 * @property string $State
 * @property string $Zip
 * @property string $Phone
 * @property string $Fax
 * @property string $Comment
 * @property string $Last_Date
 * @property string $Last_User
 * @property string $Country
 * @property integer $SupportMins
 * @property integer $ExternalID
 * @property integer $Flags
 * @property string $GUID
 * @property integer $Permissions
 * @property integer $Score
 */
class LabtechClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('labtech');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Firstname', 'LastName', 'Company', 'Address1', 'Address2', 'City', 'State', 'Zip', 'Phone', 'Fax', 'Comment', 'Last_Date', 'Last_User', 'Country', 'ExternalID', 'Flags', 'GUID', 'Permissions', 'Score'], 'required'],
            [['Last_Date'], 'safe'],
            [['SupportMins', 'ExternalID', 'Flags', 'Permissions', 'Score'], 'integer'],
            [['Name', 'Firstname', 'LastName', 'Address1', 'Address2'], 'string', 'max' => 50],
            [['Company'], 'string', 'max' => 100],
            [['City', 'Phone', 'Fax', 'Last_User'], 'string', 'max' => 30],
            [['State', 'Country'], 'string', 'max' => 20],
            [['Zip'], 'string', 'max' => 10],
            [['Comment'], 'string', 'max' => 500],
            [['GUID'], 'string', 'max' => 255],
            [['Name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ClientID' => 'Client ID',
            'Name' => 'Name',
            'Firstname' => 'Firstname',
            'LastName' => 'Last Name',
            'Company' => 'Company',
            'Address1' => 'Address1',
            'Address2' => 'Address2',
            'City' => 'City',
            'State' => 'State',
            'Zip' => 'Zip',
            'Phone' => 'Phone',
            'Fax' => 'Fax',
            'Comment' => 'Comment',
            'Last_Date' => 'Last  Date',
            'Last_User' => 'Last  User',
            'Country' => 'Country',
            'SupportMins' => 'Support Mins',
            'ExternalID' => 'External ID',
            'Flags' => 'Flags',
            'GUID' => 'Guid',
            'Permissions' => 'Permissions',
            'Score' => 'Score',
        ];
    }
}
