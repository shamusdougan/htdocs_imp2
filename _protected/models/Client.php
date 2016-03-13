<?php

namespace app\models;


use Yii;
use yii\helpers\ArrayHelper;

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
 * @property integer $defaultBillingType
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
     
    const LABTECH_KEY = 'FK1';
    
    
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
            [['name', 'defaultBillingRate', 'defaultBillingType'], 'required'],
            [['postcode', 'defaultBillingRate', 'defaultBillingType', 'accountBillTo', 'FK1', 'FK2', 'FK3', 'FK4', 'FK5', 'sync_status', 'contact_billing', 'contact_authorized', 'contact_owner'], 'integer'],
            [['last_change', 'labtech', 'state'], 'safe'],
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
            'defaultBillingType' => 'Default Billing Type',
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
	
	
	  public function getContacts()
    {
		 return $this->hasMany(clientContact::className(), ['client_id' => 'id']);
	}

	public function getClientList($indexField = 'id')
	{
	$clientList = Client::find()
				->All();
	return ArrayHelper::index($clientList, $indexField);
	}



/**
* Get default Charge Rate - This function depends on 
* 
* @return
*/
	public function getDefaultChargeRate($computerID, $computerList = false, $locationList = false, $agreementList = false)
		{
			
		//If no Ticket has been assigned to a ticket then that ticket is considered to not be under the agreement
		if(!$agreementList)
			{
			$this->agreement->getProjectRate
			}
			
			
			
		/*	
		//get the computer and work out if its covered (depends on location)
		var_dump($computerID);
		if(!$computerList)
			{
			$computer = Computers::find()
							->where(['ComputerID' => $computerID])
							->One();
			var_dump($computer);
			}
		else{
			$computer = $computerList[$computerID];
			}
		if($computer == null)
			{
			die("unable to find computer record for computer ID: ".$computerID);
			}
		*/	
		
			
			
			
			
			
		}
	
}
