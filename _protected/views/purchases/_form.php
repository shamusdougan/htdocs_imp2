<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Purchases */
/* @var $form yii\widgets\ActiveForm */




?>

<div class="purchases-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'purchase-update-form']);     ?>

	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>4,
    	
    	'attributes'=>[
    		'qty' =>['type' =>FORM::INPUT_TEXT, ],
    		'description' => 
    			[
    			'type' =>FORM::INPUT_TEXT, 
    			'label' => "Item Decription (Will appear on Invoice)",
    			'options'=>
    				[
    				'placeholder'=>'Description'
    				],
    			'columnOptions'=>['colspan'=>3],
    			
    			],
    		
    		
    	
    		]	
    	]); ?>

	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>2,
    	'attributes'=>[
    		'purchase_exGST' => 
    			[
    			'type' =>FORM::INPUT_TEXT, 
    			'label' => 'Purchase Price ExGST <a gst="ex" field="'.Html::getInputId($model, 'purchase_exGST').'" class="transformGST">(Inc/EX)</a>',
    			],
    		
    		'sell_exGST' => 
    			[
    			'type' =>FORM::INPUT_TEXT, 
    			'label' => 'Sell Price ExGST <a gst="ex" field="'.Html::getInputId($model, 'sell_exGST').'" class="transformGST">(Inc/EX)</a>',
    			
    			],
    		]
    	]); ?>
    
    
    	<?= Form::widget([
	    	'model'=>$model,
	    	'form'=>$form,
	    	'columns'=>2,
	    	'attributes'=>
	    		[
		    	'supplier_id' =>
		    		[
					'type' => Form::INPUT_WIDGET,
					'label' => 'Supplier (<A class="newSupplierLink">New</A>)',
					'widgetClass' => '\kartik\widgets\Select2',
					'options'=>
						[
						'data'=>$supplierList,
						'options' => ['placeholder' => 'Select Supplier', 'selected' => null,],
						],
		   			],			
		   		],
	   		]); ?>
    
    
 	<?= $form->field($model, 'ticket_info_id', ['template' => '{input}'])->hiddenInput()->label(false);	?>
    


    <?php ActiveForm::end(); ?>

</div>
<div>
	<?php		
		Modal::begin([
		    'id' => 'activity-modal',
		    'header' => '<h4 class="modal-title">Add Supplier</h4>',
		    'size' => 'modal-lg',
		    'options' =>
		    	[
				'tabindex' => false,
				]

		]);		?>


		<div id="modal_content">dd</div>

	<?php Modal::end(); ?>
	
</div>

<?

$this->registerJs(

	//This handles the clicking of the link to transfer inc/Ex GST fields
    "$(document).on('click', \".transformGST\", function() 
    	{
    	var targetField = $(this).attr('field');
    	targetField = $(\"#\"+targetField);
    	value = targetField.val();
    	
    	if(!isNaN(value) && value.length!=0) 
			{
			value = parseFloat(value);
			}
		else{
			value = 0;
			}
    	
    	var targetFieldGst = $(this).attr('gst');
    	
    	if(targetFieldGst == 'ex')
    		{
			$(this).text('(INC/ex)');
			$(this).attr('gst', 'inc');
			targetField.val(value*1.1);
			}
		else if(targetFieldGst =='inc')
    		{
			$(this).text('(inc/EX)');
			$(this).attr('gst', 'ex');
			targetField.val((value/1.1));
			}
		});
		
		
	$(document).on('click', \".newSupplierLink\", function()
		{
		$.ajax
	  		({
	  		url: '".yii\helpers\Url::toRoute("suppliers/ajax-add-supplier")."',
			success: function (data, textStatus, jqXHR) 
				{
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
		
		
	$('body').on('beforeSubmit', 'form#supplier-add-form', function () {
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
	          		
	          		//reload the select2 object here;
					}
			  });	
	     return false;
		});	
		
		
	

	
   ");	





?>
