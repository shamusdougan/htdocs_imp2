<?php

namespace app\controllers;

use Yii;
use app\models\Syncrelationships;
use app\models\SyncrelationshipsSearch;
use app\models\Lookup;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SyncrelationshipsController implements the CRUD actions for Syncrelationships model.
 */
class SyncrelationshipsController extends Controller
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

	    $this->view->params['menuItem'] = 'syncrelationships';

	    return true; // or false to not run the action
	}

  

    /**
     * Lists all Syncrelationships models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SyncrelationshipsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        
        $actionItems[] = ['label'=>'New', 'button' => 'new', 'url'=>"/syncrelationships/create"];
    	
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'actionItems' => $actionItems,
        ]);
    }

    /**
     * Displays a single Syncrelationships model.
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
     * Creates a new Syncrelationships model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Syncrelationships();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->index]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Syncrelationships model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->index]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Syncrelationships model.
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
     * Finds the Syncrelationships model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Syncrelationships the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Syncrelationships::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
     public function actionSync($id, $sync=false)
    {
    	
    	$actionItems[] = ['label'=>'back', 'button' => 'back', 'url'=>"/syncrelationships"];
    	$actionItems[] = ['label'=>'back', 'button' => 'back', 'url'=>"/syncrelationships"];
    	
    	
    	
    	$syncRelationshipModel = $this->findModel($id);
    	$syncModelName = $syncRelationshipModel->syncModelName;
		include_once("_protected\models\\".$syncModelName.".php");
		$syncModel = new $syncModelName();
    	
    	if($sync)
    		{
			$syncModel->executeSync($syncRelationshipModel);	
			}
    		
		return $this->render('sync', [
			'result' => $syncModel->progress,
			'model' => $syncRelationshipModel,
			'actionItems' => $actionItems,
		
			]);
	}
    
}
