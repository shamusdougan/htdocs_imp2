<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ChargeRates;

/**
 * ChargeRatesSearch represents the model behind the search form about `app\models\ChargeRates`.
 */
class ChargeRatesSearch extends ChargeRates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time_increment'], 'integer'],
            [['name', 'abriev', 'integration_1', 'integration_2', 'integration_3', 'integration_4', 'integration_5'], 'safe'],
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
        $query = ChargeRates::find();

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
            'time_increment' => $this->time_increment,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'abriev', $this->abriev])
            ->andFilterWhere(['like', 'integration_1', $this->integration_1])
            ->andFilterWhere(['like', 'integration_2', $this->integration_2])
            ->andFilterWhere(['like', 'integration_3', $this->integration_3])
            ->andFilterWhere(['like', 'integration_4', $this->integration_4])
            ->andFilterWhere(['like', 'integration_5', $this->integration_5]);

        return $dataProvider;
    }
}
