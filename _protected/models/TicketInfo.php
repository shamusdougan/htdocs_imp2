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
            [['labtech_ticket_id', 'imp_status', 'charge_rate_id', 'agreement_type_id'], 'required'],
            [['labtech_ticket_id', 'imp_status', 'charge_rate_id', 'invoice_id', 'agreement_type_id'], 'integer'],
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
            'labtech_ticket_id' => 'Labtech Ticket ID',
            'imp_status' => 'Imp Status',
            'charge_rate_id' => 'Charge Rate ID',
            'invoice_date' => 'Invoice Date',
            'invoice_id' => 'Invoice ID',
            'agreement_type_id' => 'Agreement Type ID',
        ];
    }
}
