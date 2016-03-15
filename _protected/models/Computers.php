<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "labtech.computers".
 *
 * @property integer $ComputerID
 * @property integer $ClientID
 * @property integer $LocationID
 * @property string $Name
 * @property string $Domain
 * @property string $Username
 * @property string $PCDate
 * @property string $TimeZone
 * @property string $OS
 * @property string $WinDir
 * @property string $Version
 * @property string $BiosName
 * @property string $BiosVer
 * @property string $BiosMFG
 * @property string $BiosFlash
 * @property string $USB
 * @property string $Tape
 * @property string $Sound
 * @property string $SCSI
 * @property string $Serial
 * @property string $Parallel
 * @property string $IRQ
 * @property string $DMA
 * @property string $Address
 * @property string $Ports
 * @property string $Comment
 * @property string $Permissions
 * @property string $ServiceVersion
 * @property string $LastContact
 * @property string $Password
 * @property string $Memory
 * @property string $Video
 * @property string $Processors
 * @property string $Nic
 * @property string $DNSInfo
 * @property string $LastInventory
 * @property integer $CPUUsage
 * @property integer $TotalMemory
 * @property integer $MemoryAvail
 * @property string $LocalAddress
 * @property string $RouterAddress
 * @property integer $flags
 * @property string $Modems
 * @property string $DistributedApps
 * @property string $Shares
 * @property string $BrowseList
 * @property string $VirusScanner
 * @property string $VirusDefs
 * @property integer $VirusAP
 * @property string $WindowsUpdate
 * @property string $AssetTag
 * @property string $UserAccounts
 * @property string $Licenses
 * @property string $LicensesInUse
 * @property integer $ContactID
 * @property string $UpTime
 * @property string $DataIn
 * @property string $DataOut
 * @property string $UPS
 * @property string $Tweaks
 * @property string $tempfiles
 * @property string $Assetdate
 * @property string $MAC
 * @property string $DateAdded
 * @property integer $bandwidth
 * @property string $LastUsername
 * @property string $ScoreCPU
 * @property string $ScoreD3D
 * @property string $ScoreDisk
 * @property string $ScoreGraphics
 * @property string $ScoreMemory
 * @property string $PowerProfiles
 * @property string $CurrentPwrProfile
 * @property string $SNMPCommunity
 * @property integer $FeatureFlags
 * @property string $Tracker
 * @property string $SNMPSysInfo
 * @property integer $CollectionTemplate
 * @property integer $DefaultRedirector
 * @property integer $ManagementPort
 * @property string $ManagementIP
 * @property integer $IdleTime
 * @property integer $RunLevel
 * @property string $WarrantyEnd
 * @property string $ObjectSid
 */
class Computers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'labtech.computers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ClientID', 'LocationID', 'CPUUsage', 'TotalMemory', 'MemoryAvail', 'flags', 'VirusAP', 'ContactID', 'UpTime', 'DataIn', 'DataOut', 'tempfiles', 'bandwidth', 'FeatureFlags', 'CollectionTemplate', 'DefaultRedirector', 'ManagementPort', 'IdleTime', 'RunLevel'], 'integer'],
            [['Name', 'Domain', 'Username', 'PCDate', 'OS', 'WinDir', 'Version', 'BiosName', 'BiosVer', 'BiosMFG', 'BiosFlash', 'USB', 'Tape', 'Sound', 'SCSI', 'Serial', 'Parallel', 'IRQ', 'DMA', 'Address', 'Ports', 'Comment', 'Permissions', 'ServiceVersion', 'LastContact', 'Password', 'Memory', 'Video', 'Processors', 'Nic', 'DNSInfo', 'LastInventory', 'CPUUsage', 'TotalMemory', 'MemoryAvail', 'LocalAddress', 'RouterAddress', 'flags', 'Modems', 'Shares', 'BrowseList', 'VirusScanner', 'VirusDefs', 'VirusAP', 'WindowsUpdate', 'AssetTag', 'UserAccounts', 'Licenses', 'LicensesInUse', 'ContactID', 'UpTime', 'DataIn', 'DataOut', 'UPS', 'Tweaks', 'tempfiles', 'Assetdate', 'MAC', 'DateAdded', 'bandwidth', 'LastUsername', 'ScoreCPU', 'ScoreD3D', 'ScoreDisk', 'ScoreGraphics', 'ScoreMemory', 'PowerProfiles', 'CurrentPwrProfile', 'SNMPCommunity', 'FeatureFlags', 'Tracker', 'SNMPSysInfo', 'CollectionTemplate', 'DefaultRedirector', 'ManagementPort', 'ManagementIP', 'IdleTime', 'RunLevel', 'WarrantyEnd', 'ObjectSid'], 'required'],
            [['TimeZone', 'ScoreCPU', 'ScoreD3D', 'ScoreDisk', 'ScoreGraphics', 'ScoreMemory'], 'number'],
            [['Ports', 'Permissions', 'UserAccounts'], 'string'],
            [['LastContact', 'LastInventory', 'Assetdate', 'DateAdded', 'WarrantyEnd'], 'safe'],
            [['Name', 'WinDir', 'VirusScanner', 'MAC'], 'string', 'max' => 50],
            [['Domain', 'OS', 'BiosName', 'BiosVer', 'BiosMFG', 'BiosFlash', 'AssetTag', 'CurrentPwrProfile', 'ManagementIP'], 'string', 'max' => 100],
            [['Username', 'LastUsername'], 'string', 'max' => 1000],
            [['PCDate', 'LocalAddress', 'RouterAddress'], 'string', 'max' => 30],
            [['Version'], 'string', 'max' => 60],
            [['USB', 'Tape', 'Sound', 'SCSI', 'Serial', 'Parallel', 'IRQ', 'DMA', 'Memory', 'Video', 'Processors', 'Nic', 'UPS', 'Tweaks', 'SNMPCommunity', 'Tracker'], 'string', 'max' => 255],
            [['Address', 'DistributedApps'], 'string', 'max' => 400],
            [['Comment', 'DNSInfo', 'Modems', 'Shares', 'Licenses', 'PowerProfiles'], 'string', 'max' => 500],
            [['ServiceVersion'], 'string', 'max' => 8],
            [['Password'], 'string', 'max' => 16],
            [['BrowseList'], 'string', 'max' => 2000],
            [['VirusDefs', 'LicensesInUse'], 'string', 'max' => 200],
            [['WindowsUpdate'], 'string', 'max' => 40],
            [['SNMPSysInfo'], 'string', 'max' => 150],
            [['ObjectSid'], 'string', 'max' => 184]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ComputerID' => 'Computer ID',
            'ClientID' => 'Client ID',
            'LocationID' => 'Location ID',
            'Name' => 'Name',
            'Domain' => 'Domain',
            'Username' => 'Username',
            'PCDate' => 'Pcdate',
            'TimeZone' => 'Time Zone',
            'OS' => 'Os',
            'WinDir' => 'Win Dir',
            'Version' => 'Version',
            'BiosName' => 'Bios Name',
            'BiosVer' => 'Bios Ver',
            'BiosMFG' => 'Bios Mfg',
            'BiosFlash' => 'Bios Flash',
            'USB' => 'Usb',
            'Tape' => 'Tape',
            'Sound' => 'Sound',
            'SCSI' => 'Scsi',
            'Serial' => 'Serial',
            'Parallel' => 'Parallel',
            'IRQ' => 'Irq',
            'DMA' => 'Dma',
            'Address' => 'Address',
            'Ports' => 'Ports',
            'Comment' => 'Comment',
            'Permissions' => 'Permissions',
            'ServiceVersion' => 'Service Version',
            'LastContact' => 'Last Contact',
            'Password' => 'Password',
            'Memory' => 'Memory',
            'Video' => 'Video',
            'Processors' => 'Processors',
            'Nic' => 'Nic',
            'DNSInfo' => 'Dnsinfo',
            'LastInventory' => 'Last Inventory',
            'CPUUsage' => 'Cpuusage',
            'TotalMemory' => 'Total Memory',
            'MemoryAvail' => 'Memory Avail',
            'LocalAddress' => 'Local Address',
            'RouterAddress' => 'Router Address',
            'flags' => 'Flags',
            'Modems' => 'Modems',
            'DistributedApps' => 'Distributed Apps',
            'Shares' => 'Shares',
            'BrowseList' => 'Browse List',
            'VirusScanner' => 'Virus Scanner',
            'VirusDefs' => 'Virus Defs',
            'VirusAP' => 'Virus Ap',
            'WindowsUpdate' => 'Windows Update',
            'AssetTag' => 'Asset Tag',
            'UserAccounts' => 'User Accounts',
            'Licenses' => 'Licenses',
            'LicensesInUse' => 'Licenses In Use',
            'ContactID' => 'Contact ID',
            'UpTime' => 'Up Time',
            'DataIn' => 'Data In',
            'DataOut' => 'Data Out',
            'UPS' => 'Ups',
            'Tweaks' => 'Tweaks',
            'tempfiles' => 'Tempfiles',
            'Assetdate' => 'Assetdate',
            'MAC' => 'Mac',
            'DateAdded' => 'Date Added',
            'bandwidth' => 'Bandwidth',
            'LastUsername' => 'Last Username',
            'ScoreCPU' => 'Score Cpu',
            'ScoreD3D' => 'Score D3 D',
            'ScoreDisk' => 'Score Disk',
            'ScoreGraphics' => 'Score Graphics',
            'ScoreMemory' => 'Score Memory',
            'PowerProfiles' => 'Power Profiles',
            'CurrentPwrProfile' => 'Current Pwr Profile',
            'SNMPCommunity' => 'Snmpcommunity',
            'FeatureFlags' => 'Feature Flags',
            'Tracker' => 'Tracker',
            'SNMPSysInfo' => 'Snmpsys Info',
            'CollectionTemplate' => 'Collection Template',
            'DefaultRedirector' => 'Default Redirector',
            'ManagementPort' => 'Management Port',
            'ManagementIP' => 'Management Ip',
            'IdleTime' => 'Idle Time',
            'RunLevel' => 'Run Level',
            'WarrantyEnd' => 'Warranty End',
            'ObjectSid' => 'Object Sid',
        ];
    }
    
    
    
    public function getComputer($computerID)
    	{
			return Computers::find()
								->where(['ComputerID' => $computerID])
								->One();
		}
		
		
	public function getLocation()
	{
		return $this->hasOne(Locations::className(), ['LocationID' => 'LocationID']);
	}
	
	public function getComputersList()
	{
		return Computers::find()->orderBy('Name')->All();
	}
	
}
