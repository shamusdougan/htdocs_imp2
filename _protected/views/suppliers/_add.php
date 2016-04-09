<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Purchases */
/* @var $form yii\widgets\ActiveForm */




?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'supplier-add-form']);     ?>
	<?= $form->field($model, 'active', ['template' => '{input}'])->hiddenInput()->label(false);	?>
	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>2,
    	
    	'attributes'=>[
    		'name' =>['type' =>FORM::INPUT_TEXT, ],
    		'description' => ['type' =>FORM::INPUT_TEXT, ], 
    		'address' => ['type' =>FORM::INPUT_TEXT, ],
    		'city' => ['type' =>FORM::INPUT_TEXT, ],
    		]
    	]); ?>
    	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>
     <?php ActiveForm::end(); ?>