<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\web\View;
use app\models\lookup;

/* @var $this yii\web\View */
/* @var $model app\models\Syncrelationships */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="syncrelationships-form">

<div class="delivery-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'sync-form']); ?>

   	<?= Form::widget(
			[
			'model'=>$model,
			'form'=>$form,
		
			'columns'=>1,
			'attributes' =>
				[    
				'description' =>
					[
					'type' => Form::INPUT_TEXTAREA,
					],
				'syncModelName' => ['type' => FORM::INPUT_TEXT],
				]
			]);
	?>
    
     	<?= Form::widget(
			[
			'model'=>$model,
			'form'=>$form,
		
			'columns'=>3,
			'attributes' =>
				[    
				'endPoint' => ['type' => FORM::INPUT_TEXT],
				'username' => ['type' => FORM::INPUT_TEXT],
				'password' => ['type' => FORM::INPUT_TEXT],
				'frequenyMin' => ['type' => FORM::INPUT_TEXT],
				'lastSync' => 
					[
					'type' => FORM::INPUT_TEXT,
					'options' => 
						[
						'readOnly' => true,
						]
					
					],
				'LastStatus' => 
					[
					'type' => FORM::INPUT_DROPDOWN_LIST,
					'items' => Lookup::items('SYNC_RESULT'),
					'options' => 
						[
						'disabled' => true,
						]
					],

				]
			]);
		?>
    
    	<?= Form::widget(
			[
			'model'=>$model,
			'form'=>$form,
			'columns'=>1,
			'attributes' =>
				[    
				'LastStatusData' => 
					[
					'type' => FORM::INPUT_TEXTAREA,
					'options' => 
						[
						'disabled' => true,
						]
					],
				],
			]);
		?>

    <?php ActiveForm::end(); ?>

</div>
