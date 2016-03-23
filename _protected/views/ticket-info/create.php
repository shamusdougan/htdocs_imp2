<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TicketInfo */

$this->title = 'Create Ticket Info';
$this->params['breadcrumbs'][] = ['label' => 'Ticket Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
