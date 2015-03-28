<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\client */

$this->title = "Sync ".$model->endPointName.": ".$model->endPointDataType." with ".$model->impModelName;
$this->params['breadcrumbs'][] = ['label' => 'Sync Relationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="syncExecut-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       
    </p>

  <? echo $result; ?>

</div>
