<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "labtech.locations".
 *
 * @property integer $LocationID
 * @property integer $ClientID
 * @property string $Name
 * @property string $Address
 * @property string $City
 * @property string $State
 * @property string $Zip
 * @property string $Phone
 * @property string $Fax
 * @property integer $ContactID
 * @property string $Comments
 * @property integer $Schedule
 * @property string $Router
 * @property integer $RouterPort
 * @property string $Last_Date
 * @property string $Last_User
 * @property integer $Data1
 * @property integer $Data2
 * @property string $Country
 * @property integer $PasswordID
 * @property integer $GroupID
 * @property integer $ProbeID
 * @property string $AlertMessage
 * @property integer $AlertAction
 * @property integer $TemplateID
 * @property string $SCDrive
 * @property string $SCUsername
 * @property string $SCPassword
 * @property string $SCRouterAddress
 * @property string $SCExtra1
 * @property string $SCExtra2
 * @property integer $MaintenanceID
 * @property string $MaintWindowApplied
 * @property string $SNMPCommunity
 * @property integer $DestinationID
 */
class Locations extends \yii\db\ActiveRecord
{
	
	const BILLALBE_STRING = "(NC)";
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'labtech.locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ClientID', 'ContactID', 'Schedule', 'RouterPort', 'Data1', 'Data2', 'PasswordID', 'GroupID', 'ProbeID', 'AlertAction', 'TemplateID', 'MaintenanceID', 'DestinationID'], 'integer'],
            [['Name', 'Address', 'City', 'State', 'Zip', 'Phone', 'Fax', 'Last_Date', 'Last_User', 'Country', 'PasswordID', 'GroupID', 'ProbeID', 'AlertMessage', 'AlertAction', 'TemplateID', 'SCDrive', 'SCUsername', 'SCPassword', 'SCRouterAddress', 'SCExtra1', 'SCExtra2', 'MaintenanceID', 'MaintWindowApplied', 'SNMPCommunity', 'DestinationID'], 'required'],
            [['Last_Date', 'MaintWindowApplied'], 'safe'],
            [['AlertMessage'], 'string'],
            [['Name', 'Address'], 'string', 'max' => 50],
            [['City', 'Phone', 'Fax', 'Last_User'], 'string', 'max' => 30],
            [['State', 'Country'], 'string', 'max' => 20],
            [['Zip'], 'string', 'max' => 10],
            [['Comments'], 'string', 'max' => 500],
            [['Router'], 'string', 'max' => 100],
            [['SCDrive', 'SCUsername', 'SCPassword', 'SCRouterAddress', 'SCExtra1', 'SCExtra2', 'SNMPCommunity'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LocationID' => 'Location ID',
            'ClientID' => 'Client ID',
            'Name' => 'Name',
            'Address' => 'Address',
            'City' => 'City',
            'State' => 'State',
            'Zip' => 'Zip',
            'Phone' => 'Phone',
            'Fax' => 'Fax',
            'ContactID' => 'Contact ID',
            'Comments' => 'Comments',
            'Schedule' => 'Schedule',
            'Router' => 'Router',
            'RouterPort' => 'Router Port',
            'Last_Date' => 'Last  Date',
            'Last_User' => 'Last  User',
            'Data1' => 'Data1',
            'Data2' => 'Data2',
            'Country' => 'Country',
            'PasswordID' => 'Password ID',
            'GroupID' => 'Group ID',
            'ProbeID' => 'Probe ID',
            'AlertMessage' => 'Alert Message',
            'AlertAction' => 'Alert Action',
            'TemplateID' => 'Template ID',
            'SCDrive' => 'Scdrive',
            'SCUsername' => 'Scusername',
            'SCPassword' => 'Scpassword',
            'SCRouterAddress' => 'Scrouter Address',
            'SCExtra1' => 'Scextra1',
            'SCExtra2' => 'Scextra2',
            'MaintenanceID' => 'Maintenance ID',
            'MaintWindowApplied' => 'Maint Window Applied',
            'SNMPCommunity' => 'Snmpcommunity',
            'DestinationID' => 'Destination ID',
        ];
    }
    
    
    public function getLocationList($index = 'LocationID')
    	{
		$locationList = [];
		foreach(Locations::find()->all() as $locationObject)
			{
			$locationList[$locationObject->$index] = $locationObject;
			}
		return$locationList;
		}


	public function isCovered()
		{
		if(strpos($this->Name, Locations::BILLALBE_STRING) !== false)
			{
			return False;
			}
		else{
			return true;
			}
		}
    
}
