<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Agreements */

$this->title = 'Create Agreements';
$this->params['breadcrumbs'][] = ['label' => 'Agreements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
