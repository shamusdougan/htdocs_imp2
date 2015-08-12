<?php

use yii\helpers\Html;
use app\components\actionButtons;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = 'Update Client: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-update">

 <?= actionButtons::widget(['items' => $actionItems]) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
