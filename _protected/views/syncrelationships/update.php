<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\syncrelationships */

$this->title = 'Update Syncrelationships: ' . ' ' . $model->index;
$this->params['breadcrumbs'][] = ['label' => 'Syncrelationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->index, 'url' => ['view', 'id' => $model->index]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="syncrelationships-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
