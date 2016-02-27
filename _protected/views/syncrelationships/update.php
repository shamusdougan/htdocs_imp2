<?php

use yii\helpers\Html;
use vendor\actionButtons\actionButtonsWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Syncrelationships */

$this->title = 'Update Syncrelationships: ' . ' ' . $model->index;
$this->params['breadcrumbs'][] = ['label' => 'Syncrelationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->index, 'url' => ['view', 'id' => $model->index]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="syncrelationships-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= actionButtonsWidget::widget(['items' => $actionItems])  ?></p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
