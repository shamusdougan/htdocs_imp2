<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\syncrelationships */

$this->title = 'Create Syncrelationships';
$this->params['breadcrumbs'][] = ['label' => 'Syncrelationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="syncrelationships-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
