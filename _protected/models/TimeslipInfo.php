<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timeslip_info".
 *
 * @property integer $id
 * @property double $billed_time
 * @property integer $charge_rate_id
 * @property integer $agreement_type_id
 */
class TimeslipInfo extends \yii\db\ActiveRecord
{
	
	
	 const IMPSTATUS_WIP = 1;
     const IMPSTATUS_READYINV = 2;
     const IMPSTATUS_INVOICED = 3;
     const IMPSTATUS_CLOSED = 4;
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timeslip_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['billed_time_hours', 'billed_time_mins', 'labtech_hours', 'labtech_mins', 'labtech_category'], 'number'],
            [['charge_rate_id', 'billed_time_hours', 'billed_time_mins', 'labtech_hours', 'labtech_mins', 'labtech_category'], 'required'],
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
            'billed_time_hours' => 'Billed Hours',
            'billed_time_mins' => 'Billed Mins',
            'charge_rate_id' => 'Charge Rate ID',
            
        ];
    }
    
    
    public function getTicketInfo()
    {
		 return $this->hasOne(TicketInfo::className(), ['id' => 'ticket_info_id']);
	}
	
	public function getTimeslip()
	{
		return $this->hasOne(LabtechTimeslips::className(), ['TimeSlipID' => 'labtech_timeslip_id']);
	}
	
	public function getLabtechTicket()
	{
		return $this->hasOne(LabtechTickets::className(), ['TicketID' => 'labtech_ticket_id']);
	}
	
	public function getTimeslipInfoLast($ocurrances)
	{
		return TimeslipInfo::find()->orderby('id DESC')->limit($ocurrances)->all();
	}
	
	public function checkTimeslip()
	{
		if(!isset($this->timeslip))
			{
			$this->delete();
			return "Timeslip ID: ".$this->labtech_timeslip_id." Appears to have been removed, I am removing the Timeslip Info from Imp\n";
			}
	}
	
	
	
	/**
	* Function Check detalis
	* Description: This function will check the category in the labtech timeslip as well as the hours and mins havent changed since it was last checked.
	* 				If they have changed then redo all of the billed time, charge_rate and billing account information in the timeslip
	* 
	* @return
	*/
	public function checkDetails()
	{
	
	$returnString = "";
	//First check if the category has changed, if so then we need to change the billing details accordingly
	if($this->labtech_category != $this->timeslip->Category)
		{
		$timeCategories = array_flip(Lookup::items("TimeCategory"));
		$this->assignBillingDetails($this->timeslip->Category, $timeCategories, $this->ticketInfo);
		$this->labtech_category = $this->timeslip->Category;
		$this->save();
		
		$returnString = "Timeslip id: ".$this->id." has changed is timeslip category since last check overiding all other billing details\n";
		}
	
	//If the assigned hours have changed since the last check over right the billed hours and mins
	if($this->labtech_hours != $this->timeslip->Hours || $this->labtech_mins != $this->timeslip->Mins)
		{
		$this->labtech_hours = $this->timeslip->Hours;
		$this->labtech_mins = $this->timeslip->Mins;
		$this->billed_time_hours = $this->timeslip->Hours;
		$this->billed_time_mins = $this->timeslip->Mins;
		$this->save();
		
		
		$returnString .= "Time has been changed on the timeslip manually in labtech, changing the billed time in imp to match\n";
		}
	
	if($returnString == "")
		{
		return null;
		}
		
	return $returnString;
	}
	
	
	
	public function assignBillingDetails($category_id, $timeCategories, $ticketInfo)
	{
	
	//If the caregory is set to AgreementDefauly, then assign the default rate and billing account
	if($category_id == 0 || $timeCategories['Agreement Default'] == $category_id )
		{
		$this->charge_rate_id = $ticketInfo->default_charge_rate_id;	
		$this->billing_account_id = $ticketInfo->default_billing_account_id;
		}
	elseif($timeCategories['Agreement Project'] == $category_id)
		{
		$this->charge_rate_id = $ticketInfo->client->agreement->default_project_rate_bh_id;
		$this->billing_account_id = $ticketInfo->client->agreement->default_project_account_id;
		}
	elseif($timeCategories['Not Billable'] == $category_id)
		{
		$this->charge_rate_id = ChargeRates::getNotBillableCode();
		$this->billing_account_id = Accounts::getNotBilledAccountID();
		}
	elseif($timeCategories['Agreement Default After Hours'] == $category_id)
		{
		$this->charge_rate_id = $ticketInfo->client->agreement->default_AH_rate_id;
		$this->billing_account_id = $ticketInfo->default_billing_account_id;
		}
	elseif($timeCategories['Agreement Project After Hours'] == $category_id)
		{
		$this->charge_rate_id = $ticketInfo->client->agreement->default_prohect_rate_ah_id;
		$this->billing_account_id = $ticketInfo->client->agreement->default_project_account_id;
		}
	else{
		$this->charge_rate_id = $ticketInfo->default_charge_rate_id;	
		$this->billing_account_id = $ticketInfo->default_billing_account_id;
		}
	}
	
	
	
	
}
