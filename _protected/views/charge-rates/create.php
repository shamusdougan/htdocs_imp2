<?php

use yii\helpers\Html;
use vendor\actionButtons\actionButtonsWidget;

/* @var $this yii\web\View */
/* @var $model app\models\ChargeRates */

$this->title = 'Create Charge Rate';
$this->params['breadcrumbs'][] = ['label' => 'Charge Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-rates-create">

	
	
    <h1><?= Html::encode($this->title) ?></h1>

	<?= actionButtonsWidget::widget(['items' => $actionItems]) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
