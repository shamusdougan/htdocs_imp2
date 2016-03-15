<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "labtech.ticketstatus".
 *
 * @property integer $TicketStatusID
 * @property string $TicketStatus
 */
class Ticketstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'labtech.ticketstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TicketStatusID', 'TicketStatus'], 'required'],
            [['TicketStatusID'], 'integer'],
            [['TicketStatus'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TicketStatusID' => 'Ticket Status ID',
            'TicketStatus' => 'Ticket Status',
        ];
    }
    
    
    public function getStatusList()
    {
		return Ticketstatus::find()->all();
	}
}
