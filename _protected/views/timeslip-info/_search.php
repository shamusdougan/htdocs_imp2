<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TimeslipInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timeslip-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'labtech_timeslip_id') ?>

    <?= $form->field($model, 'labtech_ticket_id') ?>

    <?= $form->field($model, 'ticket_info_id') ?>

    <?= $form->field($model, 'billed_time_hours') ?>

    <?php // echo $form->field($model, 'billed_time_mins') ?>

    <?php // echo $form->field($model, 'charge_rate_id') ?>

    <?php // echo $form->field($model, 'billing_account_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
