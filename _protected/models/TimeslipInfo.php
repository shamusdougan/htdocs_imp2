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
	
	
	public function getChargeRate()
	{
		return $this->hasOne(ChargeRates::className(), ['id' => 'charge_rate_id']);
	}
	
	public function getBilledAccount()
	{
		return $this->hasOne(Accounts::className(), ['id' => 'billing_account_id']);
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
	
	
	public function getTechName()
	{
		$user = User::findByLabtechID($this->timeslip->UserID);
		if(isset($user))
			{
			return $user->firstname;
			}
		else{
			return "Unknown";
			}
	}
	
	public function getTimeslipDate()
	{
		return date("d M Y", strtotime($this->timeslip->Date));
	}	
	
	public function getDescription()
	{
		return $this->timeslip->Description;
	}
	
	public function getTimeslipTimeString()
	{
		return $this->timeslip->Hours.":".str_pad($this->timeslip->Mins, 2, STR_PAD_LEFT);
	}
	
	public function getBilledTimeString()
	{
		return $this->billed_time_hours.":".str_pad($this->billed_time_mins,2 ,STR_PAD_LEFT);
	}
	
	
	/**
	* function isDefaultValues
	* description: this will check to see if the timeslip settings have been changed from the default values
	* 
	* @return
	*/
	public function isDefaultValues()
	{
		
		//echo $this->ticketInfo->client->agreement->default_account_id." -> ".$this->billing_account_id."<br>";
		if($this->ticketInfo->client->agreement->default_account_id != $this->billing_account_id)
			{
			return false;
			}
	
		//echo $this->ticketInfo->client->agreement->default_BH_rate_id." -> ".$this->charge_rate_id."<br>";
		if($this->ticketInfo->client->agreement->default_BH_rate_id != $this->charge_rate_id)
			{
			return false;
			}
		
		$timeArray = array('hours' => $this->labtech_hours, 'mins' => $this->labtech_mins);
		$hoursArray = $this->roundTime15Inc($timeArray);
		if($hoursArray['hours'] != $this->billed_time_hours || $hoursArray['mins'] != $this->billed_time_mins)
			{
			return false;
			}
		
		
		
			
		return true;
	}
	
	
	
	
	public function roundTime15Inc($workedTimeArray)
		{
		if(!is_array($workedTimeArray))
			{
			die("Invalid time array given to rountTime15Inc");
			}
		elseif(!array_key_exists("hours", $workedTimeArray) || !array_key_exists("mins", $workedTimeArray))
			{
			die("invalid array structure given to roundTime15Inc");
			}
			
		$billedTimeArray = $workedTimeArray;
		if($workedTimeArray['mins'] == 0)
			{
			$workedTimeArray['mins'] = 0;
			}
		elseif($workedTimeArray['mins'] <= 15)
			{
			$billedTimeArray["mins"] = 15;
			}
		elseif($workedTimeArray['mins'] <= 30)
			{
			$billedTimeArray["mins"] = 30;
			}
		elseif($workedTimeArray['mins'] <= 45)
			{
			$billedTimeArray["mins"] = 45;
			}
		else
			{
			$billedTimeArray["hours"] += 1;				
			$billedTimeArray["mins"] = 0;	
			}
			
		return $billedTimeArray;
		}
	
}
