<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChargeRatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charge-rates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'time_increment') ?>

    <?= $form->field($model, 'abriev') ?>

    <?= $form->field($model, 'integration_1') ?>

    <?php // echo $form->field($model, 'integration_2') ?>

    <?php // echo $form->field($model, 'integration_3') ?>

    <?php // echo $form->field($model, 'integration_4') ?>

    <?php // echo $form->field($model, 'integration_5') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
