<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchases".
 *
 * @property integer $id
 * @property double $qty
 * @property string $description
 * @property double $purchase_exGST
 * @property double $sell_exGST
 * @property integer $supplier_id
 * @property integer $purchase_order_id
 * @property integer $ticket_info_id
 */
class Purchases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty', 'description', 'purchase_exGST', 'sell_exGST', 'supplier_id', 'ticket_info_id'], 'required'],
            [['qty', 'purchase_exGST', 'sell_exGST'], 'number'],
            [['supplier_id', 'purchase_order_id', 'ticket_info_id'], 'integer'],
            [['description'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qty' => 'Qty',
            'description' => 'Item Description',
            'purchase_exGST' => 'Purchase Price ExGst',
            'sell_exGST' => 'Sell Price ExGst',
            'supplier_id' => 'Supplier ID',
            'purchase_order_id' => 'Purchase Order ID',
            'ticket_info_id' => 'Ticket Info ID',
            'notes' => 'Notes'
        ];
    }
}
