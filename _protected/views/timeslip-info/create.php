<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TimeslipInfo */

$this->title = 'Create Timeslip Info';
$this->params['breadcrumbs'][] = ['label' => 'Timeslip Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeslip-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
