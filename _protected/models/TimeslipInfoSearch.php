<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TimeslipInfo;

/**
 * TimeslipInfoSearch represents the model behind the search form about `app\models\TimeslipInfo`.
 */
class TimeslipInfoSearch extends TimeslipInfo
{
    /**
     * @inheritdoc
     */
    public $client_id;
    
     
    public function rules()
    {
        return [
            [['id', 'labtech_timeslip_id', 'labtech_ticket_id', 'ticket_info_id', 'billed_time_hours', 'billed_time_mins', 'charge_rate_id', 'billing_account_id'], 'integer'],
            [['client_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TimeslipInfo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'labtech_timeslip_id' => $this->labtech_timeslip_id,
            'labtech_ticket_id' => $this->labtech_ticket_id,
            'ticket_info_id' => $this->ticket_info_id,
            'billed_time_hours' => $this->billed_time_hours,
            'billed_time_mins' => $this->billed_time_mins,
            'charge_rate_id' => $this->charge_rate_id,
            'billing_account_id' => $this->billing_account_id,
        ]);

        return $dataProvider;
    }
    
    
    
      public function reviewSearch($params)
    {
        $query = TimeslipInfo::find()
        				->where(["imp_status" => TimeslipInfo::IMPSTATUS_WIP])
        				->joinWith('ticketInfo', 'labtechTicket')
        				->orderBy('client_id, labtech_ticket_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		$dataProvider->sort = false;
        $query->andFilterWhere([
            'id' => $this->id,
            'labtech_timeslip_id' => $this->labtech_timeslip_id,
            'ticket_info_id' => $this->ticket_info_id,
            'billed_time_hours' => $this->billed_time_hours,
            'billed_time_mins' => $this->billed_time_mins,
            'charge_rate_id' => $this->charge_rate_id,
            'billing_account_id' => $this->billing_account_id,
        	])
        
			->andFilterWhere(['like', 'ticket_info.client_id', $this->client_id]);

        return $dataProvider;
    }
    
    
    
}
