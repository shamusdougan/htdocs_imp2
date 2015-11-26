<?php

use yii\helpers\Html;
use vendor\actionButtons\actionButtonsWidget;

/* @var $this yii\web\View */
/* @var $model app\models\ChargeRates */

$this->title = 'Create Charge Rates';
$this->params['breadcrumbs'][] = ['label' => 'Charge Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-rates-create">

	<?= actionButtonsWidget::widget(['items' => $actionItems]) ?>
	
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
