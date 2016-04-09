<?php

use yii\helpers\Html;
use app\components\actionButtons;


/* @var $this yii\web\View */
/* @var $model app\models\Purchases */

$this->title = 'Create Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Ticket '.$ticket_info_id, 'url' => ['ticket-info/update', 'id' => '4506']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchases-create">

	<?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'supplierList' => $supplierList,
    ]) ?>

</div>
