<?php

use yii\helpers\Html;
use app\components\actionButtons;


/* @var $this yii\web\View */
/* @var $model app\models\TicketInfo */

$this->title = 'Update Labtech Ticket: ' . ' ' . $model->ticket->TicketID;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ticket-info-update">

	<?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
