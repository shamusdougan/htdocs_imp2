<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TimeslipInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timeslip-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'billed_time_hours')->textInput() ?>

    <?= $form->field($model, 'billed_time_mins')->textInput() ?>

    <?= $form->field($model, 'charge_rate_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
