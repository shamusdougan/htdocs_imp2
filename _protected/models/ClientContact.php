<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_contact".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $surname
 * @property string $phone1
 * @property string $phone2
 * @property string $mobile
 * @property string $email
 * @property integer $client_id
 * @property integer $address
 * @property integer $owner_contact
 * @property integer $accounts_contact
 * @property integer $authorized_contact
 */
class ClientContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'surname', 'client_id'], 'required'],
            [['client_id', 'address', 'owner_contact', 'accounts_contact', 'authorized_contact'], 'integer'],
            [['firstname', 'surname', 'phone1', 'phone2', 'mobile', 'email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'surname' => 'Surname',
            'phone1' => 'Land Line',
            'phone2' => 'Fax',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'client_id' => 'Client ID',
            'address' => 'Address',
            'owner_contact' => 'Owner Contact',
            'accounts_contact' => 'Accounts Contact',
            'authorized_contact' => 'Authorized Contact',
        ];
    }
    
    
    
    public function getClient()
    {
		 return $this->hasOne(Client::className(), ['id' => 'client_id']);
	}
}
