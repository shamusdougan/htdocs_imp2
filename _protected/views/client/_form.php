<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;


use kartik\widgets\ActiveForm;
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
    		'name' =>['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Company Name....'] ],
    		'ABN' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Company ABN'] ]
    	
    	]
    ]);
 
     echo Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>1,
    	'attributes'=>[
    		'address' =>['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Company Address....'] ]
    	]
    ]);
    
    echo Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>[
    		'city' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder' => 'City...'] ],
    		'state' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'State..'] ],
    		'postcode' => ['type' => FORM::INPUT_TEXT, 'options' => ['placeholder' => 'Postcode...'] ]
    		]
    
    ]);
    
    echo Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>[
    		'phone1' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder' => 'Phone Number...'] ],
    		'phone2' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'Phone Number...'] ]
    		]
    
    ]);
    
    Echo "<b>Billing Information</B>";
    
     echo Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>[
    		'defaultBillingRate' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder' => 'Billing Rate Dropdown'] ],
    		'deafultBillingType' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'Billing Type Dropdown'] ],
    		'accountBillTo' => ['type' => FORM::INPUT_TEXT, 'options' =>['placeholder' => 'Bill To Company'] ]
    		]
    
    ]);
    ?>

 
    <?= $form->field($model, 'contact_billing')->textInput() ?>

    <?= $form->field($model, 'contact_authorized')->textInput() ?>

    <?= $form->field($model, 'contact_owner')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
