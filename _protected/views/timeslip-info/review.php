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
       	'showPageSummary'=>true,
	    'pjax'=>true,
	    'striped'=>true,
	    'hover'=>true,
	    'export'=>false,
	    'panel'=>
	    	[
	    	'type'=>'primary', 
	    	'heading'=>'Review Completed Tickets'
	    	],
	    'toolbar' => false,
	    'columns' => 
	    	[
	    	[
		    	'attribute' => 'client_id',
		    	'value' => function($data)
		    		{
					return $data->ticketInfo->client->name;
					},
				'label' => 'Client',
				'group'=>true,
				'filterType'=>GridView::FILTER_SELECT2,
	    		'filter'=> ArrayHelper::map(Client::getClientList(), 'id' , "name"),
	    		'filterWidgetOptions'=>[
	        		'pluginOptions'=>['allowClear'=>true],
	    			],
    			'filterInputOptions'=>['placeholder'=>'All'],
    			'width' => '20%',
	    	],
	    	[
		    	'attribute' => 'labtech_ticket_id',
		    	'label' => 'Ticket',
		    	'width' => '5%',
		    	'group'=>true,
		    	'subGroupOf'=>0,
		    	'filter' => false,
	    	],
	    	
	    	[
	    	'attribute' => 'labtechTicket.Subject',
	    	'group'=>true,
		    'subGroupOf'=>0,
		    'width' => '20%',
	    	],
	    	
	    	
	    	[
	    	'attribute' => 'timeslip.UserID',
	    	'width' => '5%',
	    	],
	    	
	    	
	    	
	    	[
	    	'attribute' => 'timeslip.Description',
	    	'width' => '30%',
	    	],
	    	
	    	
	    	[
	    	'attribute' => 'timeslip.Hours',
	    	'width' => '5%',
	    	],
	    	
	    	
	    	[
	    	'attribute' => 'timeslip.Mins',
	    	'width' => '5%',
	        ],
	        
	        ],
	        
	        ]);?>
          
