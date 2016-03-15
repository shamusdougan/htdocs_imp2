<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Client;
use app\models\Computers;
use app\models\Ticketstatus;
use app\models\Lookup;
use yii\helpers\ArrayHelper;






/* @var $this yii\web\View */
/* @var $searchModel app\models\LabtechTicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Labtech Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labtech-tickets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
          

            [
            'attribute' => 'TicketID',
            'format' => 'raw',
            'value' => function($data)
            	{
				return Html::a($data->TicketID, ['ticket-info/update',  'id' => $data->ticketInfo->id]);
				},
            'width'=>'50px',
            ],
            [
            'attribute' => 'ClientID',
            'label' => 'Client',
            'value' => function($data){
				return Client::getClientFromLabtechID($data->ClientID)->name;
				},
			'filterType'=>GridView::FILTER_SELECT2,
    		'filter'=> ArrayHelper::map(Client::getClientList(),  Client::LABTECH_KEY, "name"),
    		'filterWidgetOptions'=>[
        		'pluginOptions'=>['allowClear'=>true],
    			],
    		'filterInputOptions'=>['placeholder'=>'All'],
    		 'width'=>'300px',
            ],
            
          
            [
            'attribute' => 'ComputerID',
            'value' => function($data)
            	{
            	if(isset($data->ComputerID) && $data->computer != null)
            		{
					return $data->computer->Name;	
					}
				return;
				},
			'filterType'=>GridView::FILTER_SELECT2,
    		'filter'=> ArrayHelper::map(Computers::getComputersList(),  'ComputerID', "Name"),
    		'filterWidgetOptions'=>[
        		'pluginOptions'=>['allowClear'=>true],
    			],
    		'filterInputOptions'=>['placeholder'=>'All'],
    		'width' => '100px',
            ],
            [
            'attribute' => 'Status',
            'value' => function ($data){
				return $data->status->TicketStatus;
				
				},
            'filterType'=>GridView::FILTER_SELECT2,
    		'filter'=> ArrayHelper::map(Ticketstatus::getStatusList(),  'TicketStatusID', "TicketStatus"),
    		'filterWidgetOptions'=>[
        		'pluginOptions'=>['allowClear'=>true],
    			],
    		'filterInputOptions'=>['placeholder'=>'All'],
    		'width' => '100px',
            ],
            [
            'attribute' => 'Subject',
            'width' => '400px',
            ],
            [
            'attribute' => 'ticketInfo.imp_status',
            'value' => function($data){
				return Lookup::item($data->ticketInfo->imp_status, "IMP_STATUS");
				},
			'width' => '100px',
            
            ],
            // 'Subject',
            // 'Time:datetime',
            // 'Priority',
            // 'UserID',
            // 'DueDate',
            // 'StartedDate',
            // 'ContactDate',
            // 'UpdateDate',
            // 'RequestorEmail:email',
            // 'CCEmail:email',
            // 'Level',
            // 'Category',
            // 'LocationID',
            // 'ExternalID',
            // 'GUID',
            // 'MonitorId',
            // 'GroupId',
            // 'MobileDeviceId',

           
        ],
    ]); ?>

</div>
