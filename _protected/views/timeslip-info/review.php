<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Client;
use app\models\Computers;
use app\models\Ticketstatus;
use app\models\Lookup;
use yii\helpers\ArrayHelper;


$this->title = 'Review Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="labtech-tickets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
         'pjax'=>true,
        'columns' => [
        	
        	[
        	'attribute' => 'ticketInfo.client_id',
        	'value' => function($data)
        		{
				return $data->ticketInfo->client->name;
				},
			'group'=>true,
        	],
        	'labtech_ticket_id',
        	'timeslip.UserID',
        	'timeslip.Description',
        	'timeslip.Hours',
        	'timeslip.Mins',
        ],
        ]);?>
          
