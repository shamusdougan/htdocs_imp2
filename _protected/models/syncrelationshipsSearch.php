<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\syncrelationships;

/**
 * syncrelationshipsSearch represents the model behind the search form about `app\models\syncrelationships`.
 */
class syncrelationshipsSearch extends syncrelationships
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['index', 'frequenyMin', 'LastStatus'], 'integer'],
            [['impModelName', 'endPointName', 'lastSync', 'LastStatusData'], 'safe'],
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
        $query = syncrelationships::find();

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
            'index' => $this->index,
            'frequenyMin' => $this->frequenyMin,
            'lastSync' => $this->lastSync,
            'LastStatus' => $this->LastStatus,
        ]);

        $query->andFilterWhere(['like', 'impModelName', $this->impModelName])
            ->andFilterWhere(['like', 'endPointName', $this->endPointName])
            ->andFilterWhere(['like', 'LastStatusData', $this->LastStatusData]);

        return $dataProvider;
    }
}
