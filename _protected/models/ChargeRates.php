<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "charge_rates".
 *
 * @property integer $id
 * @property string $name
 * @property integer $time_increment
 * @property string $abriev
 * @property string $integration_1
 * @property string $integration_2
 * @property string $integration_3
 * @property string $integration_4
 * @property string $integration_5
 */
class ChargeRates extends \yii\db\ActiveRecord
{
	
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'charge_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'time_increment', 'status', ], 'required'],
            [['time_increment'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['abriev'], 'string', 'max' => 5],
            [['integration_1', 'integration_2', 'integration_3', 'integration_4', 'integration_5'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'time_increment' => 'Time Increment',
            'abriev' => 'Abrieviation',
            'integration_1' => 'Integration 1',
            'integration_2' => 'Integration 2',
            'integration_3' => 'Integration 3',
            'integration_4' => 'Integration 4',
            'integration_5' => 'Integration 5',
        ];
    }
    
   	public function getChargeRates()
    {
		  return $this->hasMany(ChargeRatesAmounts::className(), ['charge_rate_id' => 'id' ]);
	}
  
    
}