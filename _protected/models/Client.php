<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $name
 * @property integer $ownerContact
 * @property integer $authorizedContact
 * @property integer $billingContact
 * @property string $address
 * @property string $city
 * @property integer $state
 * @property integer $postcode
 * @property integer $phone1
 * @property integer $phone2
 * @property integer $ABN
 * @property integer $IntegrationID1
 * @property integer $IntegrationID2
 * @property integer $IntegrationID3
 * @property integer $defaultBillingRate
 * @property integer $deafultBillingType
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
            [['ownerContact', 'authorizedContact', 'billingContact', 'state', 'postcode', 'phone1', 'phone2', 'ABN', 'IntegrationID1', 'IntegrationID2', 'IntegrationID3', 'defaultBillingRate', 'deafultBillingType'], 'integer'],
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
            'ownerContact' => 'Owner Contact',
            'authorizedContact' => 'Authorized Contact',
            'billingContact' => 'Billing Contact',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'postcode' => 'Postcode',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'ABN' => 'Abn',
            'IntegrationID1' => 'Integration Id1',
            'IntegrationID2' => 'Integration Id2',
            'IntegrationID3' => 'Integration Id3',
            'defaultBillingRate' => 'Default Billing Rate',
            'deafultBillingType' => 'Deafult Billing Type',
        ];
    }
}
