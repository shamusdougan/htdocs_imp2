<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SyncrelationshipsSearch */
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

    <?= $form->field($model, 'endPointType') ?>

    <?= $form->field($model, 'endPointDBServer') ?>

    <?php // echo $form->field($model, 'endPointDBName') ?>

    <?php // echo $form->field($model, 'endPointDBTable') ?>

    <?php // echo $form->field($model, 'endPointUser') ?>

    <?php // echo $form->field($model, 'endPointPassword') ?>

    <?php // echo $form->field($model, 'syncModelName') ?>

    <?php // echo $form->field($model, 'frequenyMin') ?>

    <?php // echo $form->field($model, 'lastSync') ?>

    <?php // echo $form->field($model, 'LastStatus') ?>

    <?php // echo $form->field($model, 'LastStatusData') ?>

    <?php // echo $form->field($model, 'endPointFilePath') ?>

    <?php // echo $form->field($model, 'endPointBaseURL') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
