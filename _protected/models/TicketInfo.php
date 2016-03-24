<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_info".
 *
 * @property integer $id
 * @property integer $labtech_ticket_id
 * @property integer $imp_status
 * @property string $invoice_date
 * @property integer $invoice_id
 * @property integer $agreement_type_id
 * $property integer $defauly_billing_account_id
 * @property integer $default_charge_rate_id
 * @property integer $labtech_computer_id
 * @property integer $labtech_location_id
 */
class TicketInfo extends \yii\db\ActiveRecord
{
	
	
	const DEFAULT_STATUS = 1;
	
	
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['labtech_ticket_id', 'imp_status', 'client_id', 'default_charge_rate_id', 'labtech_computer_id'], 'required'],
            [['labtech_ticket_id', 'imp_status', 'client_id', 'invoice_id', 'default_charge_rate_id', 'labtech_computer_id'], 'integer'],
            [['invoice_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'labtech_ticket_id' => 'Labtech Ticket ID',
            'imp_status' => 'Imp Status',
            'default_charge_rate_id' => 'Default Charge Rate ID',
            'invoice_date' => 'Invoice Date',
            'invoice_id' => 'Invoice ID',
        ];
    }
    
    
    
    public function getTicket()
    {
		return $this->hasOne(LabtechTickets::className(), ['TicketID' => 'labtech_ticket_id']);
	}
    
   
	public function getClient()
    {
		 return $this->hasOne(Client::className(), ['id' => 'client_id']);
	}
	
		
	public function getTimeslipsInfos()
	{
		return $this->hasMany(TimeslipInfo::className(), ["ticket_info_id" => "id"]);
	}
	
	
	public function getPurchases()
	{
		return $this->hasMany(Purchases::className(), ["ticket_info_id" => "id"]);
	}
	
	
	
	
	 public function getTicketInfo($labtech_ticket_id)
    {
	return TicketInfo::find()->where(['labtech_ticket_id' => $labtech_ticket_id])->one();
	}
	
	public function getComputer()
	{
		 return $this->hasOne(Computers::className(), ['ComputerID' => 'labtech_computer_id']);
	}
	
	
	public function getTicketInfoLast($ocurrances)
	{
		return TicketInfo::find()->orderby('id DESC')->limit($ocurrances)->all();
	}
	
	
	public function getSubject()
	{
		return $this->ticket->Subject;
	}
	
	public function getClientName()
	{
		return $this->client->name;
	}
	
	public function getComputerName()
	{
		if(isset($this->computer))
			{
			return $this->computer->Name;
			}
	}
	
	
	/**
	* This function will check that the cimputerID for the ticket hasn't changed since the last wupdate. If it has changed then we need to update the billing information
	*'
	* 
	* @return
	*/
	public function checkComputerID()
	{
	if($this->ticket->ComputerID != $this->labtech_computer_id)
		{
		$returnString = "Found the Computer Assigned to Ticket: ".$this->labtech_ticket_id." changed since last update. Updating the chargerate accordindly\n";
		$this->default_charge_rate_id = $this->client->getDefaultChargeRate($this->ticket->ComputerID);
		$this->default_billing_account_id = $this->client->agreement->default_account_id;
		$this->labtech_computer_id = $this->ticket->ComputerID;
		$this->save();
		return $returnString;
		}
	}



	/**
	* check Ticket
	* Description: this function will check to see if the ticket for this ticket info still exists, if it doesn't then the ticketInfo object needs to be also remvoed from the system'
	* 
	* @return
	*/
	public function checkTicket()
	{
		if(!isset($this->ticket))
			{
			$this->delete();
			return "Ticket ID: ".$this->labtech_ticket_id." Appears to have been removed or combined removing the Ticket Info from Imp\n";
			}
	}


	public function isInvoiced()
	{
		if(isset($this->invoice_id))
			{
				return true;
			}
		return false;
	}


	
	
}

