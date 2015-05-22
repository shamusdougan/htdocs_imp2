<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Syncrelationships */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="syncrelationships-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'impModelName')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointName')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointType')->textInput() ?>

    <?= $form->field($model, 'endPointDBServer')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointDBName')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointDBTable')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointUser')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointPassword')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'syncModelName')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'frequenyMin')->textInput() ?>

    <?= $form->field($model, 'lastSync')->textInput() ?>

    <?= $form->field($model, 'LastStatus')->textInput() ?>

    <?= $form->field($model, 'LastStatusData')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'endPointFilePath')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'endPointBaseURL')->textInput(['maxlength' => 500]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
