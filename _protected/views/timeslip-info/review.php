<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Client;
use app\models\Computers;
use app\models\Ticketstatus;
use app\models\Lookup;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;


$this->title = 'Review Tickets';
$this->params['breadcrumbs'][] = $this->title;



  $this->registerJs(
    "$(document).on('click', '.materials-view-link', function() 
    	{
		$.ajax
  		({
  		url: '".yii\helpers\Url::toRoute("timeslip-info/modal-materials-view")."',
		data: {id: $(this).closest('tr').data('key')},
		success: function (data, textStatus, jqXHR) 
			{
			$('.modal-body').removeData('bs.modal').find('.modal-content').empty();
			$('#activity-modal').modal();
			$('.modal-body').html(data);
          

			},
        error: function (jqXHR, textStatus, errorThrown) 
        	{
            console.log('An error occured!');
            alert('Error in ajax request' );
        	}
		});
		});
	"
   );


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
	    	'format' => 'raw',
	    	'value' => function ($data){
				//return $data->labtechTicket->Subject;
				
				$returnString = $data->labtechTicket->Subject."<br>";
				return $returnString.Html::a('Materials','#', 
                	[
                    'class' => 'materials-view-link',
                    'title' => 'Materials',
					]);
			
				
					
			},
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
				return $data->timeslip->Description;
				},
	    	'width' => '35%',
	    	],

			[
			'attribute' => 'timeslip.Hours',
			'value' => function ($data) {
				return $data->timeslip->Hours.":".str_pad($data->timeslip->Mins, 2, "0", STR_PAD_LEFT);
				
				},
			 'width'=>'5%',
			 'hAlign' => 'right',
			],
			[
			'class'=>'kartik\grid\EditableColumn',
		    'attribute'=>'billed_time_hours',
		    'editableOptions'=>[
		        'header'=>'Hours',
		        'inputType'=>'textInput',
		    	],
		    'hAlign'=>'right',
		    'vAlign'=>'top',
		    'width'=>'5%',
		    'format'=>['decimal', 0],
		    'filter' => false,
	
	    	],
//	    	[
//	    	'attribute' => 'billed_time_hours',
//	    	'width' => '5%',
//	    	'filter' => false,
//	    	],
	    	
	    	
	    
	        
	        [
			'class'=>'kartik\grid\EditableColumn',
		    'attribute'=>'billed_time_mins',
		    'editableOptions'=>[
		        'header'=>'Hours',
		        'inputType'=>'textInput',
		    	],
		    'hAlign'=>'right',
		    'vAlign'=>'top',
		    'width'=>'5%',
		    'format'=>['decimal', 0],
		    'filter' => false,
	
	    	],
	        
	        [
        	'class' => '\kartik\grid\CheckboxColumn',
        	'width' => '5%',
    		],
	        ],
	        
	        ]);?>
          
<?php		
Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">Materials Information</h4>',
    'size' => 'modal-lg',

]);		?>


<div id="modal_content"></div>

<?php

Modal::end(); 

?>