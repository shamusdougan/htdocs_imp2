<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use kartik\widgets\SideNav;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    
    <div class='sapient_wrap'>
    	<div class='sapient_leftMenu'>
    		<?php 
    		
    		$username = Yii::$app->user->identity->username;
    		echo SideNav::widget([
				'type' => SideNav::TYPE_DEFAULT,
				'heading' => "IMP 2.0.0 Menu (".$username.")",
				'items' => [
					['label' => 'Dashboard', 'icon' => 'home'],
					['label' => 'Settings', 'icon' => 'cog'],
					['label' => 'Logout', 'icon' => 'off', 'url' => 'site/logout']
				
				]
				]);        
				?>
    	</div>
    	<div class='sapient_content'>
    		 <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    	</div>
    	
    </div>
    
       
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
