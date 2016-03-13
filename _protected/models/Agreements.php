<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agreements".
 *
 * @property integer $id
 * @property string $name
 * @property integer $default_account_id
 * @property integer $default_BH_rate_id
 * @property integer $default_AH_rate_id
 * @property integer $default_project_rate_bh_id
 * @property integer $default_project_rate_ah_id
 */
class Agreements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agreements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'default_account_id', 'default_BH_rate_id', 'default_AH_rate_id', 'default_project_rate_bh_id', 'default_project_rate_ah_id'], 'required'],
            [['default_account_id', 'default_BH_rate_id', 'default_AH_rate_id', 'default_project_rate_bh_id', 'default_project_rate_ah_id'], 'integer'],
            [['name'], 'string', 'max' => 200]
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
            'default_account_id' => 'Default Account ID',
            'default_BH_rate_id' => 'Default  Bh Rate ID',
            'default_AH_rate_id' => 'Default  Ah Rate ID',
            'default_project_rate_bh_id' => 'Default Project Rate Bh ID',
            'default_project_rate_ah_id' => 'Default Project Rate Ah ID',
        ];
    }
}
