<?php

use yii\helpers\Html;


use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Suppliers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suppliers-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'supplier-update-form']);     ?>
    
    <?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>1,
    	'attributes'=>
    		[
    		'name' => 
    			[
    			'type' => FORM::INPUT_TEXT, 
    			'options' =>
    				[
    				'placeholder' => 'Supplier Name'
    				]
    			],
    		'description' =>
    			[
    			'type' => FORM::INPUT_TEXTAREA, 
    			],
    		'active' =>
    			[
    			'type' => FORM::INPUT_CHECKBOX
    			]
    		],
    	]);?>
    	
    <?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>2,
    	'attributes'=>[
    		'address' => 
    			[
    			'type' => FORM::INPUT_TEXT, 
    			
    			],
    		'city' =>
    			[
    			'type' => FORM::INPUT_TEXT, 
    			],
    		
    		],
    	]);?>
    		

    

    <?php ActiveForm::end(); ?>

</div>
