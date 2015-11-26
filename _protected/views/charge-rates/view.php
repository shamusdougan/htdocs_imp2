<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChargeRates */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Charge Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-rates-view">

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
            'time_increment:datetime',
            'abriev',
            'integration_1',
            'integration_2',
            'integration_3',
            'integration_4',
            'integration_5',
        ],
    ]) ?>

</div>
