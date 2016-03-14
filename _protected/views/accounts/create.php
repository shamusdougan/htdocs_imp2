<?php

use yii\helpers\Html;
use app\components\actionButtons;

/* @var $this yii\web\View */
/* @var $model app\models\accounts */

$this->title = 'Create Accounts';
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-create">

	<?= actionButtons::widget(['items' => $actionItems]) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
