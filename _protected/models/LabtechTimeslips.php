<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timeslips".
 *
 * @property integer $TimeSlipID
 * @property integer $UserID
 * @property integer $ClientID
 * @property integer $ProjectID
 * @property integer $TicketID
 * @property integer $Hours
 * @property integer $Mins
 * @property integer $Done
 * @property string $Date
 * @property string $Description
 * @property integer $Billed
 * @property integer $Category
 */
class LabtechTimeslips extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timeslips';
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
            [['UserID', 'Date', 'Description'], 'required'],
            [['UserID', 'ClientID', 'ProjectID', 'TicketID', 'Hours', 'Mins', 'Done', 'Billed', 'Category'], 'integer'],
            [['Date'], 'safe'],
            [['Description'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TimeSlipID' => 'Time Slip ID',
            'UserID' => 'User ID',
            'ClientID' => 'Client ID',
            'ProjectID' => 'Project ID',
            'TicketID' => 'Ticket ID',
            'Hours' => 'Hours',
            'Mins' => 'Mins',
            'Done' => 'Done',
            'Date' => 'Date',
            'Description' => 'Description',
            'Billed' => 'Billed',
            'Category' => 'Category',
        ];
    }
    
    public function getLabtechTicket()
    {
		return $this->hasOne(LabtechTickets::className(), ['TicketID' => 'TicketID']);
	}
	
	public function getTimeslipInfo()
	{
		return $this->hasOne(TimeslipInfo::className(), ['labtech_timeslip_id' => 'TimeSlipID']);
	}
    
}
