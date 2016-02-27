<?php

use yii\helpers\Html;

use vendor\actionButtons\actionButtonsWidget;


/* @var $this yii\web\View */
/* @var $model app\models\Syncrelationships */

$this->title = 'Create Syncrelationships';
$this->params['breadcrumbs'][] = ['label' => 'Syncrelationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="syncrelationships-create">

    <h1><?= Html::encode($this->title) ?></h1>
      <p><?= actionButtonsWidget::widget(['items' => $actionItems])  ?></p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
