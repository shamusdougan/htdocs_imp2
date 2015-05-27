<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\lookup;

/* @var $this yii\web\View */
/* @var $model app\models\Syncrelationships */
/* @var $form yii\widgets\ActiveForm */


$this->registerJs("
	$(document).ready(function () {changeEndPointType();});
	
	
	



", View::POS_LOAD);

?>
<script type="text/javascript">
	
	function changeEndPointType(){
		value = $('#syncrelationships-endpointtype option:selected').text();
		
		if(value == "Database"){
			$("#databaseSection").show();
			$("#FileSection").hide();
			$("#WebSection").hide();
			}
		
		if(value == "Webpage"){
			$("#databaseSection").hide();
			$("#FileSection").hide();
			$("#WebSection").show();
			}
		if(value == "File"){
			$("#databaseSection").hide();
			$("#FileSection").show();
			$("#WebSection").hide();
			}
		
		
		}
	
</script>
<div class="syncrelationships-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'impModelName')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointName')->textInput(['maxlength' => 200]) ?>
    
     <?= $form->field($model, 'syncModelName')->textInput(['maxlength' => 200]) ?>
     
    <?= $form->field($model, 'frequenyMin')->textInput() ?>
    
    <?= $form->field($model, 'lastSync')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'LastStatus')->textInput(['readonly' => true]) ?>
    
    <?= $form->field($model, 'LastStatusData')->textInput(['maxlength' => 500, 'readonly' => true]) ?>

    <?= $form->field($model, 'endPointType')->dropDownList(Lookup::items("SyncEndPointType"), ['prompt' => '---- Select Type ----', 'onchange' => 'javascript:changeEndPointType()' ]) ?>
    
    <?= $form->field($model, 'endPointUser')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointPassword')->textInput(['maxlength' => 200]) ?>


    <div id="databaseSection">
	    <?= $form->field($model, 'endPointDBServer')->textInput(['maxlength' => 200]) ?>

	    <?= $form->field($model, 'endPointDBName')->textInput(['maxlength' => 200]) ?>

	    <?= $form->field($model, 'endPointDBTable')->textInput(['maxlength' => 200]) ?>
    </div>
	<div id='FileSection'>
      	<?= $form->field($model, 'endPointFilePath')->textInput(['maxlength' => 200]) ?>
    </div>
	<div id="WebSection">
    	<?= $form->field($model, 'endPointBaseURL')->textInput(['maxlength' => 500]) ?>
    </div>
    
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
