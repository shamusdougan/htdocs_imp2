<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agreements;

/**
 * AgreementsSearch represents the model behind the search form about `app\models\Agreements`.
 */
class AgreementsSearch extends Agreements
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'default_account_id', 'default_BH_rate_id', 'default_AH_rate_id', 'default_project_rate_bh_id', 'default_project_rate_ah_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = Agreements::find();

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
            'default_account_id' => $this->default_account_id,
            'default_BH_rate_id' => $this->default_BH_rate_id,
            'default_AH_rate_id' => $this->default_AH_rate_id,
            'default_project_rate_bh_id' => $this->default_project_rate_bh_id,
            'default_project_rate_ah_id' => $this->default_project_rate_ah_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
