<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LabtechTickets;

/**
 * LabtechTicketsSearch represents the model behind the search form about `app\models\LabtechTickets`.
 */
class LabtechTicketsSearch extends LabtechTickets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TicketID', 'ClientID', 'ProjectID', 'ComputerID', 'Status', 'Time', 'Priority', 'UserID', 'Level', 'Category', 'LocationID', 'ExternalID', 'MonitorId', 'GroupId', 'MobileDeviceId'], 'integer'],
            [['Subject', 'DueDate', 'StartedDate', 'ContactDate', 'UpdateDate', 'RequestorEmail', 'CCEmail', 'GUID'], 'safe'],
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
        $query = LabtechTickets::find();

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
            'TicketID' => $this->TicketID,
            'ClientID' => $this->ClientID,
            'ProjectID' => $this->ProjectID,
            'ComputerID' => $this->ComputerID,
            'Status' => $this->Status,
            'Time' => $this->Time,
            'Priority' => $this->Priority,
            'UserID' => $this->UserID,
            'DueDate' => $this->DueDate,
            'StartedDate' => $this->StartedDate,
            'ContactDate' => $this->ContactDate,
            'UpdateDate' => $this->UpdateDate,
            'Level' => $this->Level,
            'Category' => $this->Category,
            'LocationID' => $this->LocationID,
            'ExternalID' => $this->ExternalID,
            'MonitorId' => $this->MonitorId,
            'GroupId' => $this->GroupId,
            'MobileDeviceId' => $this->MobileDeviceId,
        ]);

        $query->andFilterWhere(['like', 'Subject', $this->Subject])
            ->andFilterWhere(['like', 'RequestorEmail', $this->RequestorEmail])
            ->andFilterWhere(['like', 'CCEmail', $this->CCEmail])
            ->andFilterWhere(['like', 'GUID', $this->GUID]);

        return $dataProvider;
    }
}
