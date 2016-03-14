<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "labtech.timecategory".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $Extra1
 * @property integer $Extra2
 */
class Timecategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'labtech.timecategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Extra1', 'Extra2'], 'required'],
            [['Extra2'], 'integer'],
            [['Name'], 'string', 'max' => 30],
            [['Extra1'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'Extra1' => 'Extra1',
            'Extra2' => 'Extra2',
        ];
    }
}
