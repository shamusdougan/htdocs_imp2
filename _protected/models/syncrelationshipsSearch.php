<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Syncrelationships;

/**
 * SyncrelationshipsSearch represents the model behind the search form about `app\models\Syncrelationships`.
 */
class SyncrelationshipsSearch extends Syncrelationships
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['index', 'endPointType', 'frequenyMin', 'LastStatus'], 'integer'],
            [['impModelName', 'endPointName', 'endPointDBServer', 'endPointDBName', 'endPointDBTable', 'endPointUser', 'endPointPassword', 'syncModelName', 'lastSync', 'LastStatusData', 'endPointFilePath', 'endPointBaseURL'], 'safe'],
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
        $query = Syncrelationships::find();

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
            'endPointType' => $this->endPointType,
            'frequenyMin' => $this->frequenyMin,
            'lastSync' => $this->lastSync,
            'LastStatus' => $this->LastStatus,
        ]);

        $query->andFilterWhere(['like', 'impModelName', $this->impModelName])
            ->andFilterWhere(['like', 'endPointName', $this->endPointName])
            ->andFilterWhere(['like', 'endPointDBServer', $this->endPointDBServer])
            ->andFilterWhere(['like', 'endPointDBName', $this->endPointDBName])
            ->andFilterWhere(['like', 'endPointDBTable', $this->endPointDBTable])
            ->andFilterWhere(['like', 'endPointUser', $this->endPointUser])
            ->andFilterWhere(['like', 'endPointPassword', $this->endPointPassword])
            ->andFilterWhere(['like', 'syncModelName', $this->syncModelName])
            ->andFilterWhere(['like', 'LastStatusData', $this->LastStatusData])
            ->andFilterWhere(['like', 'endPointFilePath', $this->endPointFilePath])
            ->andFilterWhere(['like', 'endPointBaseURL', $this->endPointBaseURL]);

        return $dataProvider;
    }
}
