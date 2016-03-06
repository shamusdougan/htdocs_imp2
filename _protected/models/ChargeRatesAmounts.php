<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "charge_rates_amounts".
 *
 * @property integer $id
 * @property string $valid_from_date
 * @property double $amount
 * @property integer $charge_rate_id
 */
class ChargeRatesAmounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'charge_rates_amounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valid_from_date', 'amount', 'charge_rate_id'], 'required'],
            [['valid_from_date'], 'safe'],
            [['amount'], 'number'],
            [['charge_rate_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valid_from_date' => 'Date Valid From',
            'amount' => 'Amount',
            'charge_rate_id' => 'Charge Rate ID',
        ];
    }
    
    
    
}
