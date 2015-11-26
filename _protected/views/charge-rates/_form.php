<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\ChargeRates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charge-rates-form">

     
<?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id' => 'charge-rate-form']);  ?>  

	<?= $form->errorSummary($model); ?>  
	<?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
	
	<?= Form::widget([
    	'model'=>$model,
    	'form'=>$form,
    	'columns'=>3,
    	'attributes'=>
    		[
    		'name' =>['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Charge Rate Name.'] ],
    		'abriev' => ['type' =>FORM::INPUT_TEXT, 'options'=>['placeholder'=>'Abrievation (optional)'] ],
    		'time_increment' => 
    			[
    			'type' =>FORM::INPUT_DROPDOWN_LIST, 
    			'items' => ['1' => '1 min increments', 5 => '5 min increments', 6 => '6 min increments (0.1 Hour)', 10 => '10 min increments', '15' => '15 min increments', 30 => '30 min Increments', 60 => '1 Hour Increments'], 
    			]
    		]
    	]);
    ?>
    	
    	
    	
    <?= $this->render("/charge-rates-amounts/_chargeRatesSingleGrid", ['model' => $model, 'form' => $form]) ?>
    




    <?php ActiveForm::end(); ?>

</div>


<div>
	<?php		
		Modal::begin([
		    'id' => 'activity-modal',
		    'header' => '<h4 class="modal-title">Add Price</h4>',
		    'size' => 'modal-md',
		    'options' =>
		    	[
				'tabindex' => false,
				]

		]);		?>


		<div id="modal_content">dd</div>

	<?php Modal::end(); ?>
	
</div>
