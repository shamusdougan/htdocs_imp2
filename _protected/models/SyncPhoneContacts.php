<?php
use app\models\Client;
use app\models\ClientContact;


require_once("SyncModelBase.php");

class syncPhoneContacts extends syncModelBase

{
	
	var $syncType = syncModelBase::LOCAL_OVERIDE_REMOTE;
	
	

	
	//mapping array are all From->To ("impFieldName" => "RemoteFieldName")
	var $fieldMapping = [
		"firstname" => "Firstname",
		"surname" => "LastName",
		"phone1" => "Phone",
		"phone2" => "Fax",
		"mobile" => "Cell",
		"email" => "Email",
		"address" => "Address1",
		'City' => 'City',
		'Postcode' => 'Zip',
		'State' => 'State',

		];
	
	var $fileHandle;
	
	


	/*
		Function: getLocalRecordsChangedSince
		input
		$dateTime: the given date/time of the last successfuly syncLabtechClient
		output:
		should return anarray of records changed since the last sync, the array should be indexed on record id. */
	function getLocalRecords()
		{
		return ClientContact::find()->all();
		}


	
	

	
	/*
		function: transfeToRemote()
		inputs: none
		output: none
		description: takes the list of records from the internal $this->localRecords and transfers to the remote database.
					this uses the SQL statements to transfer the data into the remote database
	*/
	function transferToRemote($syncRelationship)
	{
	
	
	$xml = new SimpleXMLElement('<YealinkIPPhoneBook></YealinkIPPhoneBook>');

	$phonebook = $xml->addChild('Title', 'Yealink');
	$menu = $xml->addChild("Menu");
	$menu->addAttribute('Name', "Company Contacts");
	
	foreach($this->localRecords as $contact)
		{
		$contactEntry = $menu->addChild("Unit");
		$contactEntry->addAttribute("Name", $contact->firstname." ".$contact->surname." - ".$contact->client->name);
		$contactEntry->addAttribute("Phone1", $contact->phone1);
		$contactEntry->addAttribute("Phone2", $contact->phone2);
		$contactEntry->addAttribute("Phone3", $this->formatMobile($contact->mobile));
		}
	
	$this->progress .= "Updating remote File\n";
	
	
	fwrite($this->fileHandle, $xml->asXML());
	
	
	}
	
	
	
	public function formatMobile($numberString)
	{
	$returnString = str_replace(" ", "", $numberString);
	if(strpos($returnString, "0") === 0)
		{
		$returnString = substr($returnString, 1);
		$returnString = "61".$returnString;
		}
		
		
		
	return $returnString;
	}
	
	
}


?>