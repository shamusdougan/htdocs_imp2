<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\datePicker;
use kartik\datecontrol\DateControl;
use kartik\builder\Form;
?>


<?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'price_add']); ?>
  
 
<?php


   echo Form::widget([
		    	'model'=>$model,
		    	'form'=>$form,
		    	'columns'=>2,
		    	'attributes'=>
		    		[
		    		'amount' => ['type' => FORM::INPUT_TEXT],
		    		'valid_from_date' =>
		    			[
		    			'type'=>Form::INPUT_WIDGET, 
           				'widgetClass'=>'\kartik\widgets\DatePicker', 
            			
            			'options' =>
								[
								'type' => DatePicker::TYPE_COMPONENT_APPEND,
								'pluginOptions'=>
									[
									'autoclose'=>true,
									'format' => 'dd-M-yyyy'
									
									
									],
								],
						
		    			],
		    		/*
		  			'ingredient_id' =>
		    			[
		    				'type' => Form::INPUT_WIDGET,
		    				'widgetClass' => '\kartik\widgets\Select2',
		    				'options'=>
		    					[
		    					'data'=>$productList,
		    					'options' => ['placeholder' => 'Select Product....', 'selected' => null,],
		    					'hideSearch' => false,
		    					],
		    				'columnOptions'=>['colspan'=>2],
		    				'label' => false,
							
						],	
		    		'ingredient_percent' => 
		    			[
		    			'type' => Form::INPUT_WIDGET,
		    			'widgetClass' => '\kartik\widgets\TouchSpin',
		    			'options' =>
		    				[
							'name' => 'Percentage',
							'pluginOptions' => 
								[
								'min' => 0, 
								'max' => 100, 
								'postfix' => '%',
								'step' => 0.001,
								'decimals' => 3,
								],
		    				],
		    			'columnOptions'=>['colspan'=>2],
		    			'label' =>false,
		    			],
					*/
		    		 'actions'=>
		    		 	[
		    		 	'type'=>Form::INPUT_RAW, 
		    		 	'value'=>Html::submitButton('Add', ['class'=>'btn btn-primary'])
		    		 	]
		    		]
		    	]);
   ?>
   
   
	<?= $form->field($model, 'charge_rate_id')->hiddenInput()->label(false) ;  ?>
		    	
		    	
		    	<?php
ActiveForm::end(); 

?>