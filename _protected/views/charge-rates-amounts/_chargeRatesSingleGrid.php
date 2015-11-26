<?php
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;




/* @var $model app\models\ChargeRates */
/* @var $form yii\widgets\ActiveForm */

	
$this->registerJs(
	"$(document).on('click', '#add_price_button', function()
		{
			
		charge_rate_id = $(this).attr('charge_rate_id');
		if(typeof charge_rate_id =='undefined' )
			{
			alert('Please save the Charge Rate before adding prices');
			return;
			}
		
		$.ajax
	  		({
	  		url: '".yii\helpers\Url::toRoute("charge-rates-amounts/ajax-create")."',
			data: {charge_rate_id: charge_rate_id},
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
");


$this->registerJs("
$('body').on('beforeSubmit', 'form#price_add', function () {
     var form = $(this);
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) 
          		{
          		$('#activity-modal').modal('hide');
          		$.pjax.reload({container:'#price-grid'});
				}
		  });	
     return false;
	});
	");


 $this->registerJs(
    "$(document).on('click', \"#refresh_price_grid\", function() 
    	{
    	$.pjax.reload({container:\"#price-grid\"});
		});"
   );	



  $this->registerJs(
    "$(document).on('click', '.price-update-link', function() 
    	{
		$.ajax
  		({
  		url: '".yii\helpers\Url::toRoute("charge-rates-amounts/ajax-update")."',
		data: {id: $(this).closest('tr').data('key')},
		success: function (data, textStatus, jqXHR) 
			{
			$('.modal-body').removeData('bs.modal').find('.modal-content').empty();
			
			$('.modal-body').html(data);
         	$('#activity-modal').modal();

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

$this->registerJs(
    "$(document).on('click', '.price-delete-link', function() 
    	{
		$.ajax
  		({
  		url: '".yii\helpers\Url::toRoute("charge-rates-amounts/ajax-delete")."',
		data: {id: $(this).closest('tr').data('key')},
		success: function (data, textStatus, jqXHR) 
			{
			$.pjax.reload({container:\"#price-grid\"});
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

$gridColumns = [
	[
	'attribute' => 'valid_from_date',
	'value' => function($model)
		{
		return date ("d M Y", strtotime($model->valid_from_date))	;
		}
	],
	['attribute' => 'amount'],
	
	
	[
	    'class'=>'kartik\grid\ActionColumn',
		'template' => '{update} {delete}',
		'contentOptions' => ['class' => 'padding-left-5px'],

	   	'buttons' => 
	   		[
	   		'delete' => function ($url, $model, $key) 
	   			{
                return Html::a('<span class="glyphicon glyphicon-trash"></span>','#', 
                	[
                    'class' => 'price-delete-link',
                    'title' => 'Delete',
					]);
				},
			'update' => function ($url, $model, $key) 
	   			{
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>','#', 
                	[
                    'class' => 'price-update-link',
                    'title' => 'Update',
					]);
				},
			],
	    'headerOptions'=>['class'=>'kartik-sheet-style'],
	],
	
	];		

echo GridView::widget(
		[
		'id' => 'charge-rate-amount-grid',
		'panel'=>[
        		'type'=>GridView::TYPE_PRIMARY,
        		'heading'=>"Charge Rates",
   		 ],
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'toolbar'=> 
			[
				['content'=>
					Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Contact', 'class'=>'btn btn-success', 'charge_rate_id' => $model->id, 'id' => 'add_price_button' ]) . ' '.
					Html::button('<i class="glyphicon glyphicon-repeat"></i>', ['type'=>'button', 'title'=>'Refresh', 'id' => 'refresh_price_grid', 'class'=>'btn btn-success'])
				],
			],
		'dataProvider'=> new yii\data\ActiveDataProvider(['query' => $model->getChargeRates()]),
		//'filterModel'=>$searchModel,
		'columns'=>$gridColumns,
		'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
		'headerRowOptions'=>['class'=>'kartik-sheet-style'],
		'filterRowOptions'=>['class'=>'kartik-sheet-style'],
		'pjax'=>true, 
		'pjaxSettings' =>
			[
			'neverTimeout'=>true,
			'options' =>['id' => 'price-grid'],
			
			],
 		'export' => false,
		]);

?>



