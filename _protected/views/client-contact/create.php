<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientContact */

$this->title = 'Create Client Contact';
$this->params['breadcrumbs'][] = ['label' => 'Client Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
