<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_info".
 *
 * @property integer $id
 * @property integer $labtech_ticket_id
 * @property integer $imp_status
 * @property integer $charge_rate_id
 * @property string $invoice_date
 * @property integer $invoice_id
 * @property integer $agreement_type_id
 */
class TicketInfo extends \yii\db\ActiveRecord
{
	
	
	const DEFAULT_STATUS = 1;
	
	
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['labtech_ticket_id', 'imp_status', 'client_id', 'default_charge_rate_id'], 'required'],
            [['labtech_ticket_id', 'imp_status', 'client_id', 'invoice_id', 'default_charge_rate_id'], 'integer'],
            [['invoice_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'labtech_ticket_id' => 'Labtech Ticket ID',
            'imp_status' => 'Imp Status',
            'default_charge_rate_id' => 'Default Charge Rate ID',
            'invoice_date' => 'Invoice Date',
            'invoice_id' => 'Invoice ID',
        ];
    }
    
    
    
    public function getTicketInfo($labtech_ticket_id)
    {
	return TicketInfo::find()->where(['labtech_ticket_id' => $labtech_ticket_id])->one();
	}
	
	public function getClient()
    {
		 return $this->hasOne(Client::className(), ['id' => 'client_id']);
	}
	
	
	
}
