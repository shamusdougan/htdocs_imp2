<?php

use yii\helpers\Html;
use app\components\actionButtons;

/* @var $this yii\web\View */
/* @var $model app\models\accounts */

$this->title = 'Update Accounts: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accounts-update">

	<?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
