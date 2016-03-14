<?php

namespace app\controllers;

use Yii;
use app\models\accounts;
use app\models\accountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountsController implements the CRUD actions for accounts model.
 */
class AccountsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


	public function beforeAction($action)
	{
	    if (!parent::beforeAction($action)) {
	        return false;
	    }
	    
	    $this->view->params['menuItem'] = 'accounts';

	    return true; // or false to not run the action
	}


    /**
     * Lists all accounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new accountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$actionItems[] = ['label'=>'New', 'button' => 'new', 'url'=>"/accounts/create"];
		
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'actionItems' => $actionItems,
        ]);
    }

    /**
     * Displays a single accounts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new accounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new accounts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        	{
            return $this->redirect(['index']);
        	}
        else 
        	{
        	
        	
        	
			$actionItems[] = ['label'=>'Save', 'button' => 'save', 'url'=>null, 'submit'=> 'account_form', 'confirm' => 'Save Client Information and Exit?'];
	    	$actionItems[] = ['label'=>'Cancel', 'button' => 'cancel', 'url'=>'/accounts/index', 'confirm' => 'Cancel Changes?'];
	        	
	        	
	        return $this->render('create', [
	                'model' => $model,
	                'actionItems' => $actionItems,
	            ]);
        	}
    }

    /**
     * Updates an existing accounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        	{
            return $this->redirect(['index']);
        	}
        else {
        	
        	
        	$actionItems[] = ['label'=>'Save', 'button' => 'save', 'url'=>null, 'submit'=> 'account_form', 'confirm' => 'Save Client Information and Exit?'];
	    	$actionItems[] = ['label'=>'Cancel', 'button' => 'cancel', 'url'=>'/accounts/index', 'confirm' => 'Cancel Changes?'];
	       
            return $this->render('update', [
                'model' => $model,
                'actionItems' => $actionItems
            ]);
        }
    }

    /**
     * Deletes an existing accounts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the accounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return accounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = accounts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
