<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Agreements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agreements-form">

  <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'agreement_form']);  ?>  
	<?= $form->errorSummary($model); ?>  
	
	
	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>
    		[
    		'name' =>
    			[
    			'type' =>FORM::INPUT_TEXT, 
    			'options'=>
    				[
    				'placeholder'=>'Enter Agreement Name.',
    				] 
    			],
    		]
    	]); ?>
    	
    	
    
    	<div style='padding-left: 5px; padding-right: 5px; width: 100%; border-radius: 15px;  background: #EFEFEF;'>
    	<h2>Covered Rates</h2>
    	Agreement Rates for Machines covered under the agreement. Rates for all other machines/work specified below.<br><br>
    		
    		
    	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>
    		[
    		'default_account_id' => 
    			[
    			'type' =>FORM::INPUT_DROPDOWN_LIST, 
    			'items' => $accountsList, 
    			],
    		'default_BH_rate_id' => 
    			[
    			'type' =>FORM::INPUT_DROPDOWN_LIST, 
    			'items' => $chargeRates, 
    			],
    		'default_AH_rate_id' => 
    			[
    			'type' =>FORM::INPUT_DROPDOWN_LIST, 
    			'items' => $chargeRates, 
    			]
    		]
    	]);
    ?>
   </div>
	<div style='padding-left: 5px; padding-right: 5px; width: 100%; border-radius: 15px;  background: #EFEFEF;'>
    	<h2>Other charge rates</h2>
    	For all of the machines or work NOT covered under this agreement the following rates apply<br><br>
 	
 	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>
    		[
    		'default_project_account_id' => 
    			[
    			'type' =>FORM::INPUT_DROPDOWN_LIST, 
    			'items' => $accountsList, 
    			],
    		'default_project_rate_bh_id' => 
    			[
    			'type' =>FORM::INPUT_DROPDOWN_LIST, 
    			'items' => $chargeRates, 
    			],
    		'default_project_rate_ah_id' => 
    			[
    			'type' =>FORM::INPUT_DROPDOWN_LIST, 
    			'items' => $chargeRates, 
    			]
    		]
    	]);
    
	?>
    <?php ActiveForm::end(); ?>

</div>
