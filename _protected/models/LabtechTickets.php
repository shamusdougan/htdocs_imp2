<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property integer $TicketID
 * @property integer $ClientID
 * @property integer $ProjectID
 * @property integer $ComputerID
 * @property integer $Status
 * @property string $Subject
 * @property integer $Time
 * @property integer $Priority
 * @property integer $UserID
 * @property string $DueDate
 * @property string $StartedDate
 * @property string $ContactDate
 * @property string $UpdateDate
 * @property string $RequestorEmail
 * @property string $CCEmail
 * @property integer $Level
 * @property integer $Category
 * @property integer $LocationID
 * @property integer $ExternalID
 * @property string $GUID
 * @property integer $MonitorId
 * @property integer $GroupId
 * @property integer $MobileDeviceId
 */
class LabtechTickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tickets';
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
            [['ClientID', 'ProjectID', 'ComputerID', 'Status', 'Time', 'Priority', 'UserID', 'Level', 'Category', 'LocationID', 'ExternalID', 'MonitorId', 'GroupId', 'MobileDeviceId'], 'integer'],
            [['Subject', 'StartedDate', 'ContactDate', 'UpdateDate', 'RequestorEmail', 'CCEmail', 'Level', 'Category', 'LocationID', 'ExternalID', 'GUID', 'MonitorId', 'GroupId', 'MobileDeviceId'], 'required'],
            [['DueDate', 'StartedDate', 'ContactDate', 'UpdateDate'], 'safe'],
            [['Subject', 'CCEmail'], 'string', 'max' => 255],
            [['RequestorEmail', 'GUID'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TicketID' => 'Ticket ID',
            'ClientID' => 'Client ID',
            'ProjectID' => 'Project ID',
            'ComputerID' => 'Computer ID',
            'Status' => 'Labtech Status',
            'Subject' => 'Subject',
            'Time' => 'Time',
            'Priority' => 'Priority',
            'UserID' => 'User ID',
            'DueDate' => 'Due Date',
            'StartedDate' => 'Started Date',
            'ContactDate' => 'Contact Date',
            'UpdateDate' => 'Update Date',
            'RequestorEmail' => 'Requestor Email',
            'CCEmail' => 'Ccemail',
            'Level' => 'Level',
            'Category' => 'Category',
            'LocationID' => 'Location ID',
            'ExternalID' => 'External ID',
            'GUID' => 'Guid',
            'MonitorId' => 'Monitor ID',
            'GroupId' => 'Group ID',
            'MobileDeviceId' => 'Mobile Device ID',
        ];
    }
    
    public function getComputer()
    {
		 return $this->hasOne(Computers::className(), ['ComputerID' => 'ComputerID']);
	}
	
	public function getStatus()
	{
		return $this->hasOne(Ticketstatus::className(), ['TicketStatusID' => 'Status']);
	}
    
    public function getTicketInfo()
    {
		return $this->hasOne(TicketInfo::className(), ['labtech_ticket_id' => 'TicketID']);
	}
    
}
