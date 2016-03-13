<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgreementsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agreements-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'default_account_id') ?>

    <?= $form->field($model, 'default_BH_rate_id') ?>

    <?= $form->field($model, 'default_AH_rate_id') ?>

    <?php // echo $form->field($model, 'default_project_rate_bh_id') ?>

    <?php // echo $form->field($model, 'default_project_rate_ah_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
