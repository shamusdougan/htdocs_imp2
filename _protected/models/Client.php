<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property integer $state
 * @property integer $postcode
 * @property integer $phone1
 * @property integer $phone2
 * @property integer $ABN
 * @property integer $defaultBillingRate
 * @property integer $deafultBillingType
 * @property integer $accountBillTo
 * @property integer $FK1
 * @property integer $FK2
 * @property integer $FK3
 * @property integer $FK4
 * @property integer $FK5
 * @property string $last_change
 * @property integer $sync_status
 * @property integer $contact_billing
 * @property integer $contact_authorized
 * @property integer $contact_owner
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'defaultBillingRate', 'deafultBillingType'], 'required'],
            [['state', 'postcode', 'phone1', 'phone2', 'ABN', 'defaultBillingRate', 'deafultBillingType', 'accountBillTo', 'FK1', 'FK2', 'FK3', 'FK4', 'FK5', 'sync_status', 'contact_billing', 'contact_authorized', 'contact_owner'], 'integer'],
            [['last_change'], 'safe'],
            [['name', 'address', 'city'], 'string', 'max' => 500]
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
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'postcode' => 'Postcode',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'ABN' => 'Abn',
            'defaultBillingRate' => 'Default Billing Rate',
            'deafultBillingType' => 'Deafult Billing Type',
            'accountBillTo' => 'Account Bill To',
            'FK1' => 'Fk1',
            'FK2' => 'Fk2',
            'FK3' => 'Fk3',
            'FK4' => 'Fk4',
            'FK5' => 'Fk5',
            'last_change' => 'Last Change',
            'sync_status' => 'Sync Status',
            'contact_billing' => 'Contact Billing',
            'contact_authorized' => 'Contact Authorized',
            'contact_owner' => 'Contact Owner',
        ];
    }
    
    public function beforeSave($insert)
    {
		$this->last_change =  date("Y-m-d H:i:s");
		return parent::beforeSave($insert);

	}
}
