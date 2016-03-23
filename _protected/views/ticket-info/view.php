<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TicketInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'labtech_ticket_id',
            'client_id',
            'imp_status',
            'invoice_date',
            'invoice_id',
            'default_billing_account_id',
            'default_charge_rate_id',
            'labtech_computer_id',
        ],
    ]) ?>

</div>
