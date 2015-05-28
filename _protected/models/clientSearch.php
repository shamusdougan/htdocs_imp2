<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form about `app\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state', 'postcode', 'phone1', 'phone2', 'ABN', 'defaultBillingRate', 'deafultBillingType', 'accountBillTo', 'FK1', 'FK2', 'FK3', 'FK4', 'FK5', 'sync_status', 'contact_billing', 'contact_authorized', 'contact_owner'], 'integer'],
            [['name', 'address', 'city', 'last_change'], 'safe'],
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
        $query = Client::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'state' => $this->state,
            'postcode' => $this->postcode,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'ABN' => $this->ABN,
            'defaultBillingRate' => $this->defaultBillingRate,
            'deafultBillingType' => $this->deafultBillingType,
            'accountBillTo' => $this->accountBillTo,
            'FK1' => $this->FK1,
            'FK2' => $this->FK2,
            'FK3' => $this->FK3,
            'FK4' => $this->FK4,
            'FK5' => $this->FK5,
            'last_change' => $this->last_change,
            'sync_status' => $this->sync_status,
            'contact_billing' => $this->contact_billing,
            'contact_authorized' => $this->contact_authorized,
            'contact_owner' => $this->contact_owner,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}
