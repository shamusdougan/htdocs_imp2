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
            [['name', 'agreement_id'], 'required'],
            [['postcode', 'agreement_id', 'accountBillTo', 'FK1', 'FK2', 'FK3', 'FK4', 'FK5', 'sync_status', 'contact_billing', 'contact_authorized', 'contact_owner'], 'integer'],
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
            'agreement_id' => 'Agreement',
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

	
	public function getAgreement()
	{
		return $this->hasOne(Agreements::className(), ['id' => 'agreement_id']);
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
			
		//get the agreement covering this machine, get it from the cached list if not fetch directly
		if(!$agreementList){
			$agreement = $this->agreement;
			}
		else{
			$agreement = $agreementList[$this->agreement_id];
			}
		
		//If none of the below criteria are meet then use not covered rate
		$chargeRate = $agreement->default_project_rate_bh_id;
		
		//if the ticket has a computer ID set and the computer can be found in the database then check the computer location
		//if the computer location has "(NC)" in the name then the machine is not covered under the agreement
		if($computerID != 0 && ($computer = Computers::getComputer($computerID)) != null)
			{
			if(!$locationList)
				{
				$location = Locations::findOne($computer->LocationID);
				}
			else{
				$lcoation = $locationList[$computer->LocationID];
				}
				
			//check the computer Location
			if($location != null && $location->isCovered())
				{
				$chargeRate = $agreement->default_BH_rate_id;
				//echo "Computer: ".$computer->Name." Location: ".$computer->location->Name." ChargeRate: ".$agreement->defaultBHRate->name."<br>";
				
				}
			}
		//else{
			//echo "ComputerID: ".$computerID."<br>";
		//}
		
		return $chargeRate;
		}
	
	
	
}
