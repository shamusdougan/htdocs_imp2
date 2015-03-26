<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'ownerContact')->textInput() ?>

    <?= $form->field($model, 'authorizedContact')->textInput() ?>

    <?= $form->field($model, 'billingContact')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'postcode')->textInput() ?>

    <?= $form->field($model, 'phone1')->textInput() ?>

    <?= $form->field($model, 'phone2')->textInput() ?>

    <?= $form->field($model, 'ABN')->textInput() ?>

    <?= $form->field($model, 'IntegrationID1')->textInput() ?>

    <?= $form->field($model, 'IntegrationID2')->textInput() ?>

    <?= $form->field($model, 'IntegrationID3')->textInput() ?>

    <?= $form->field($model, 'defaultBillingRate')->textInput() ?>

    <?= $form->field($model, 'deafultBillingType')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
