<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LabtechTimeslips;

/**
 * LabtechTimeslipsSearch represents the model behind the search form about `app\models\LabtechTimeslips`.
 */
class LabtechTimeslipsSearch extends LabtechTimeslips
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TimeSlipID', 'UserID', 'ClientID', 'ProjectID', 'TicketID', 'Hours', 'Mins', 'Done', 'Billed', 'Category'], 'integer'],
            [['Date', 'Description'], 'safe'],
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
        $query = LabtechTimeslips::find()
        		->joinWith('labtechTicket', 'TicketInfo')
        		->where(['Status' => LabtechTickets::STATUS_RESOLVED])
        		->andWhere("Date > '".$this->startingDate."'";
        		

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
            'TimeSlipID' => $this->TimeSlipID,
            'UserID' => $this->UserID,
            'ClientID' => $this->ClientID,
            'ProjectID' => $this->ProjectID,
            'TicketID' => $this->TicketID,
            'Hours' => $this->Hours,
            'Mins' => $this->Mins,
            'Done' => $this->Done,
            'Date' => $this->Date,
            'Billed' => $this->Billed,
            'Category' => $this->Category,
        ]);

        $query->andFilterWhere(['like', 'Description', $this->Description]);

        return $dataProvider;
    }
    
    
    
    
    
    
    
    
    
}
