<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\syncrelationshipsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="syncrelationships-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'index') ?>

    <?= $form->field($model, 'impModelName') ?>

    <?= $form->field($model, 'endPointName') ?>

    <?= $form->field($model, 'frequenyMin') ?>

    <?= $form->field($model, 'lastSync') ?>

    <?php // echo $form->field($model, 'LastStatus') ?>

    <?php // echo $form->field($model, 'LastStatusData') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
