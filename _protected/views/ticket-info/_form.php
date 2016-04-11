<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\Lookup;
use app\models\Accounts;
use app\models\ChargeRates;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TicketInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-info-form">

<?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'ticket-info-update-form']);     ?>


	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>2,
    	'attributes'=>[
    		'clientName' => 
    			[
    			'type' =>FORM::INPUT_TEXT, 
    			'options'=>
    				[
    				'disabled' => true,
    				] 
    			],
    		'computerName' =>
    			[
    			'type' => FORM::INPUT_TEXT,
    			'options' =>
    				[
    				'disabled' => true,
    				]
    			
    			],
    		]
    	]); ?>
    	
    	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>1,
    	'attributes'=>[
    		'subject' =>
    			[
    			'type' => FORM::INPUT_TEXTAREA,
    			'options' =>
    				[
    				'disabled' => true,
    				]
    			]
    	]
    ]); ?>
   
   
   
   <?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>[
    		'imp_status' =>
    			[
    			'type' => FORM::INPUT_DROPDOWN_LIST, 
    			'items' => Lookup::items('IMP_STATUS'),
    			'options' =>
    				[
    				'disabled' => $model->isInvoiced(),
    				]
    			],
    		'default_billing_account_id' =>
    			[
    			'type' => FORM::INPUT_DROPDOWN_LIST,
    			'items' => Accounts::getDropDownArray(),
    			'options' =>
    				[
    				'disabled' => $model->isInvoiced(),
    				]
    			],
    		'default_charge_rate_id' =>
    			[
    			'type' => FORM::INPUT_DROPDOWN_LIST,
    			'items' => ChargeRates::getDropDownArray(),
    			'options' =>
    				[
    				'disabled' => $model->isInvoiced(),
    				]
    			]
    	]
    ]); ?>
    <?php ActiveForm::end(); ?>
    
     <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query' => $model->getTimeslipsInfos()]),
		'panel'=>[
			'type'=>GridView::TYPE_PRIMARY,
        	'heading'=>"Timeslips",
    		],
    	'toolbar'=> 
			[
				['content'=>
					Html::button('<i class="glyphicon glyphicon-arrow-down"></i>', ['type'=>'button', 'title'=>'Update Timeslip Details', 'id' => 'update_timeslip_grid', 'class'=>'btn btn-success']).
					Html::button('<i class="glyphicon glyphicon-repeat"></i>', ['type'=>'button', 'title'=>'Refresh', 'id' => 'refresh_timeslip_grid', 'class'=>'btn btn-success'])
					],
			],
        'export' => false,
        'pjax'=>true, 
		'pjaxSettings' =>
			[
			'neverTimeout'=>true,
			'options' =>['id' => 'timeslip-grid'],
			
			],
        'columns' => [
        	'timeslipDate',
        	[
        	'label' => 'Tech',
        	'attribute' => 'TechName',
        	],
        	'description',
        	[
        	'attribute'=>'timeslipTimeString',
        	'label' =>"Time",
        	],
        	[
        	'attribute'=>'billedTimeString',
        	'label' =>"Billed",
        	],
        	'chargeRate.name:TEXT:Charge Rate',
        	'billedAccount.name:TEXT:Account',
        	]
        ]); ?>
    
    
      <? 
      
      if(count($model->purchases) > 0)
      {
		echo GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query' => $model->getPurchases()]),
		'panel'=>[
			'type'=>GridView::TYPE_PRIMARY,
        	'heading'=>"Materials",
    		],
    	'toolbar' => false,
        'export' => false,
        'columns' => [
        	'description:TEXT:Materials',
        	'qty:TEXT:Quantity',
        	'purchase_exGST:TEXT:Purchase ExGST',
        	'sell_exGST',
        	'purchase_order_id',
        	]
        ]);
	  }
      ?>

</div>


<?
 $this->registerJs(
    "$(document).on('click', \"#refresh_timeslip_grid\", function() 
    	{
    	$.pjax.reload({container:\"#timeslip-grid\"});
		});
	
	$(document).on('click', \"#update_timeslip_grid\", function() 	
		{
		$.ajax({
			url: '/ticket-info/update-timeslips?id=".$model->id."',
			type: 'post',
			success: function (response) 
				{
          		$.pjax.reload({container:\"#timeslip-grid\"});
          		
				}
		  	});	
		  	
		  	
		  	
		});

	"
   );	
 
?>