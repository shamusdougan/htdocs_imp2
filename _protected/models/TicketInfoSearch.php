<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TicketInfo;

/**
 * TicketInfoSearch represents the model behind the search form about `app\models\TicketInfo`.
 */
class TicketInfoSearch extends TicketInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'labtech_ticket_id', 'client_id', 'imp_status', 'invoice_id', 'default_billing_account_id', 'default_charge_rate_id', 'labtech_computer_id'], 'integer'],
            [['invoice_date'], 'safe'],
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
        $query = TicketInfo::find();

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
            'labtech_ticket_id' => $this->labtech_ticket_id,
            'client_id' => $this->client_id,
            'imp_status' => $this->imp_status,
            'invoice_date' => $this->invoice_date,
            'invoice_id' => $this->invoice_id,
            'default_billing_account_id' => $this->default_billing_account_id,
            'default_charge_rate_id' => $this->default_charge_rate_id,
            'labtech_computer_id' => $this->labtech_computer_id,
        ]);

        return $dataProvider;
    }
}
