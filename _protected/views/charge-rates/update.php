<?php

use yii\helpers\Html;
use app\components\actionButtons;

/* @var $this yii\web\View */
/* @var $model app\models\ChargeRates */

$this->title = 'Update Charge Rates: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Charge Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];

?>
<div class="charge-rates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= actionButtons::widget(['items' => $actionItems]) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
