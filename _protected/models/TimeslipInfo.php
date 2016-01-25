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
            [['billed_time'], 'number'],
            [['charge_rate_id', 'agreement_type_id'], 'required'],
            [['charge_rate_id', 'agreement_type_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'billed_time' => 'Billed Time',
            'charge_rate_id' => 'Charge Rate ID',
            'agreement_type_id' => 'Agreement Type ID',
        ];
    }
}
