<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agreements".
 *
 * @property integer $id
 * @property string $name
 * @property integer $default_account_id
 * @property integer $default_BH_rate_id
 * @property integer $default_AH_rate_id
 * @property integer $default_project_rate_bh_id
 * @property integer $default_project_rate_ah_id
 */
class Agreements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agreements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'default_account_id', 'default_BH_rate_id', 'default_AH_rate_id', 'default_project_account_id', 'default_project_rate_bh_id', 'default_project_rate_ah_id'], 'required'],
            [['default_account_id', 'default_BH_rate_id', 'default_AH_rate_id', 'default_project_account_id', 'default_project_rate_bh_id', 'default_project_rate_ah_id'], 'integer'],
            [['name'], 'string', 'max' => 200]
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
            'default_account_id' => 'Account',
            'default_BH_rate_id' => 'BH Rate',
            'default_AH_rate_id' => 'AH Rate',
            'default_project_account_id' => 'Project Account',
            'default_project_rate_bh_id' => 'Project BH Rate',
            'default_project_rate_ah_id' => 'Project AH Rate',
        ];
    }
    
    
    
    public function getDefaultAccount()
    {
		 return $this->hasOne(Accounts::className(), ['id' => 'default_account_id']);
	}
    
    public function getDefaultBHRate()
    {
		 return $this->hasOne(ChargeRates::className(), ['id' => 'default_BH_rate_id']);
	}
    
     public function getDefaultAHRate()
    {
		 return $this->hasOne(ChargeRates::className(), ['id' => 'default_AH_rate_id']);
	}
    
    public function getDefaultProjAccount()
    {
		 return $this->hasOne(Accounts::className(), ['id' => 'default_project_account_id']);
	}
    
     public function getDefaultProjBHRate()
    {
		 return $this->hasOne(ChargeRates::className(), ['id' => 'default_project_rate_bh_id']);
	}
    
    public function getDefaultProjAHRate()
    {
		 return $this->hasOne(ChargeRates::className(), ['id' => 'default_project_rate_ah_id']);
	}
    
    
    public function getDropDownArray()
	{
		$agreementArray = [];
		foreach(Agreements::find()->All() as $agreement)
			{
			$agreementArray[$agreement->id] = $agreement['name'];
			}
		
		return $agreementArray;
		
		
	}
    
}
