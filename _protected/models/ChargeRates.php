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
  
  
  	public function getCurrentRate()
  	{
	return $this->getRate(time());
	}
  


	public function getRate($phpTime)
	{
	$currentChargeRate = ChargeRatesAmounts::find()
							->Where(['charge_rate_id' => $this->id])
							->AndWhere("`valid_from_date` < '".date("Y-m-d", $phpTime)."'")
							->OrderBy('valid_from_date DESC')
							->limit(1)
							->one();
							
	if($currentChargeRate == null)
		{
		return 0;
		}
	return $currentChargeRate->amount;
	}
	
	
	public function getDropDownArray()
		{
		$chargeRateArray = [];
		foreach(ChargeRates::find()->all() as $chargeRateObject)
			{
			$chargeRateArray[$chargeRateObject->id] = $chargeRateObject->name." (".$chargeRateObject->getCurrentRate().")";
			}	
			
		return $chargeRateArray;
			
		}
	
	public function getNotBillableCode()
		{
		$chargeRate = ChargeRates::find()->where(['name' => 'Not Billable'])->one();
		if($chargeRate == null)
			{
			die("unable to find not billable code for charge rate in database");		
			}
		return $chargeRate->id;
		}
	
    
}
