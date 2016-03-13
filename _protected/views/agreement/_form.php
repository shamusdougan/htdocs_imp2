<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Agreements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agreements-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_account_id')->textInput() ?>

    <?= $form->field($model, 'default_BH_rate_id')->textInput() ?>

    <?= $form->field($model, 'default_AH_rate_id')->textInput() ?>

    <?= $form->field($model, 'default_project_rate_bh_id')->textInput() ?>

    <?= $form->field($model, 'default_project_rate_ah_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
