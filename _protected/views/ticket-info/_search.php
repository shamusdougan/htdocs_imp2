<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TicketInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'labtech_ticket_id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'imp_status') ?>

    <?= $form->field($model, 'invoice_date') ?>

    <?php // echo $form->field($model, 'invoice_id') ?>

    <?php // echo $form->field($model, 'default_billing_account_id') ?>

    <?php // echo $form->field($model, 'default_charge_rate_id') ?>

    <?php // echo $form->field($model, 'labtech_computer_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
