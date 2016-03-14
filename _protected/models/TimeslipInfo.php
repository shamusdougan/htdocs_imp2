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
            [['billed_time_hours', 'billed_time_mins'], 'number'],
            [['charge_rate_id', 'billed_time_hours', 'billed_time_mins'], 'required'],
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
}
