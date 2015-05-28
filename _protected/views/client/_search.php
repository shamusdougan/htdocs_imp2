<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'phone1') ?>

    <?php // echo $form->field($model, 'phone2') ?>

    <?php // echo $form->field($model, 'ABN') ?>

    <?php // echo $form->field($model, 'defaultBillingRate') ?>

    <?php // echo $form->field($model, 'deafultBillingType') ?>

    <?php // echo $form->field($model, 'accountBillTo') ?>

    <?php // echo $form->field($model, 'FK1') ?>

    <?php // echo $form->field($model, 'FK2') ?>

    <?php // echo $form->field($model, 'FK3') ?>

    <?php // echo $form->field($model, 'FK4') ?>

    <?php // echo $form->field($model, 'FK5') ?>

    <?php // echo $form->field($model, 'last_change') ?>

    <?php // echo $form->field($model, 'sync_status') ?>

    <?php // echo $form->field($model, 'contact_billing') ?>

    <?php // echo $form->field($model, 'contact_authorized') ?>

    <?php // echo $form->field($model, 'contact_owner') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
