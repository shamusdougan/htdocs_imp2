<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

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
            'name',
            'address',
            'city',
            'state',
            'postcode',
            'phone1',
            'phone2',
            'ABN',
            'defaultBillingRate',
            'deafultBillingType',
            'accountBillTo',
            'FK1',
            'FK2',
            'FK3',
            'FK4',
            'FK5',
            'last_change',
            'sync_status',
            'contact_billing',
            'contact_authorized',
            'contact_owner',
        ],
    ]) ?>

</div>
