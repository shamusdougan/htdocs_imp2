<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suppliers".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $active
 * @property string $address
 * @property string $city
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'active', 'city'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 300],
            [['address', 'city'], 'string', 'max' => 100]
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
            'description' => 'Description',
            'active' => 'Active',
            'address' => 'Address',
            'city' => 'City/Suburb',
        ];
    }
}
