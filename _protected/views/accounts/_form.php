<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\models\accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">
	
    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'account_form']);  ?>  
	<?= $form->errorSummary($model); ?>  
	
	Accounts are used to track the hours spent on various jobs, an account can be billable or not. If it is billable then the timeslip will be elible to be billed

	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>1,
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
    		'billable' =>
    			[
    			'type' => FORM::INPUT_CHECKBOX,
    			
    			]
    		]
    	]); ?>
    	

 

   

    <?php ActiveForm::end(); ?>

</div>
