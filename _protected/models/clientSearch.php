<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\client;

/**
 * clientSearch represents the model behind the search form about `app\models\client`.
 */
class clientSearch extends client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ownerContact', 'authorizedContact', 'billingContact', 'state', 'postcode', 'phone1', 'phone2', 'ABN', 'IntegrationID1', 'IntegrationID2', 'IntegrationID3', 'defaultBillingRate', 'deafultBillingType'], 'integer'],
            [['name', 'address', 'city'], 'safe'],
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
        $query = client::find();

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
            'ownerContact' => $this->ownerContact,
            'authorizedContact' => $this->authorizedContact,
            'billingContact' => $this->billingContact,
            'state' => $this->state,
            'postcode' => $this->postcode,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'ABN' => $this->ABN,
            'IntegrationID1' => $this->IntegrationID1,
            'IntegrationID2' => $this->IntegrationID2,
            'IntegrationID3' => $this->IntegrationID3,
            'defaultBillingRate' => $this->defaultBillingRate,
            'deafultBillingType' => $this->deafultBillingType,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}
