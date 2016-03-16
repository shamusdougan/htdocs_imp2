<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TimeslipInfo */

$this->title = 'Update Timeslip Info: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Timeslip Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="timeslip-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
