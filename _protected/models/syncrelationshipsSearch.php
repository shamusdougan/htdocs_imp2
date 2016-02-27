<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SyncRelationships;

/**
 * SyncRelationshipsSearch represents the model behind the search form about `app\models\SyncRelationships`.
 */
class SyncRelationshipsSearch extends SyncRelationships
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['index', 'frequenyMin', 'LastStatus'], 'integer'],
            [['description', 'syncModelName', 'endPoint', 'username', 'password', 'lastSync', 'LastStatusData'], 'safe'],
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
        $query = SyncRelationships::find();

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
            'index' => $this->index,
            'frequenyMin' => $this->frequenyMin,
            'lastSync' => $this->lastSync,
            'LastStatus' => $this->LastStatus,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'syncModelName', $this->syncModelName])
            ->andFilterWhere(['like', 'endPoint', $this->endPoint])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'LastStatusData', $this->LastStatusData]);

        return $dataProvider;
    }
}
