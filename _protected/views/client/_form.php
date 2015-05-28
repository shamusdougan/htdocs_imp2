<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); 
    
    
    
    echo Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>2,
    	'attributes'=>[
    		'name' =>['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Company Name....'] ]
    	
    	]
    ]);
    
    
    
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'postcode')->textInput() ?>

    <?= $form->field($model, 'phone1')->textInput() ?>

    <?= $form->field($model, 'phone2')->textInput() ?>

    <?= $form->field($model, 'ABN')->textInput() ?>

    <?= $form->field($model, 'defaultBillingRate')->textInput() ?>

    <?= $form->field($model, 'deafultBillingType')->textInput() ?>

    <?= $form->field($model, 'accountBillTo')->textInput() ?>

    <?= $form->field($model, 'contact_billing')->textInput() ?>

    <?= $form->field($model, 'contact_authorized')->textInput() ?>

    <?= $form->field($model, 'contact_owner')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
