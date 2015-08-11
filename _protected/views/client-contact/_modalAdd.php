<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model app\models\ClientContact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-contact-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'modal_add_contact']); ?>

	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>2,
    	'attributes'=>[
    		'firstname' =>['type' =>FORM::INPUT_TEXT, ],
    		'surname' => ['type' =>FORM::INPUT_TEXT],
    		'phone1' =>['type' =>FORM::INPUT_TEXT],
    		'phone2' => ['type' =>FORM::INPUT_TEXT],  
    		'mobile' => ['type' =>FORM::INPUT_TEXT],  
    		'email' => ['type' =>FORM::INPUT_TEXT],  
    		'address' => 
    			[
    			'type' =>FORM::INPUT_TEXT,
    			'columnOptions' => 
    				[
    				'colspan' => 2,
    				]
    			],  
    		'City' => ['type' =>FORM::INPUT_TEXT],
    		'Postcode' => ['type' =>FORM::INPUT_TEXT],
    		'State' => ['type' =>FORM::INPUT_TEXT],
    		'Notes' => 
    			[
    			'type' =>FORM::INPUT_TEXTAREA,
    			'columnOptions' => 
    				[
    				'colspan' => 2,
    				]
    			],
    		'client_id' =>['type' =>FORM::INPUT_HIDDEN, 'label' => false],
    	]
    ]);
?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
