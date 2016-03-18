<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Client;
use app\models\Computers;
use app\models\Ticketstatus;
use app\models\Lookup;
use app\models\User;
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
    			'width' => '15%',
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
	    	'value' => function ($data)
	    		{
	    		$user = User::findByLabtechID($data->timeslip->UserID);
	    		if(isset($user))
	    			{
					return $user->firstname;
					}
				else{
					return "Unknown";
					}
				
				},
	    	'width' => '5%',
	    	],
	    	
	    	
	    	
	    	[
	    	'attribute' => 'timeslip.Description',
	    	'value' => function ($data)
	    		{
				return "(".$data->timeslip->Hours.":".$data->timeslip->Mins.") ".$data->timeslip->Description;
				},
	    	'width' => '35%',
	    	],


			[
			'class'=>'kartik\grid\EditableColumn',
		    'attribute'=>'billed_time_hours',
		    'editableOptions'=>[
		        'header'=>'Hours',
		        'inputType'=>'textInput',
		        //'options'=>['pluginOptions'=>['min'=>0, 'max'=>5]]
		    	],
		    'hAlign'=>'right',
		    'vAlign'=>'middle',
		    'width'=>'10%',
		    'format'=>['decimal', 2],
	
	    	],
//	    	[
//	    	'attribute' => 'billed_time_hours',
//	    	'width' => '5%',
//	    	'filter' => false,
//	    	],
	    	
	    	
	    	[
	    	'attribute' => 'billed_time_mins',
	    	'width' => '5%',
	    	'filter' => false,
	        ],
	        [
        	'class' => '\kartik\grid\CheckboxColumn',
        	'width' => '5%',
    		],
	        ],
	        
	        ]);?>
          
