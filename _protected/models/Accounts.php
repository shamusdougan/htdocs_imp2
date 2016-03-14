<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property integer $id
 * @property string $name
 * @property integer $billable
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'billable'], 'required'],
            [['billable'], 'integer'],
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
            'billable' => 'Billable',
        ];
    }
    
    
    
    
    public function getAccountsList()
    {
		return Accounts::find()->All();
	}
	
	
	public function getDropDownArray()
	{
		$accountsArray = [];
		foreach(Accounts::find()->All() as $account)
			{
			$accountsArray[$account->id] = $account['name'] . ($account->billable ? " (Billable) ": "");
			}
		
		return $accountsArray;
		
		
	}
}
