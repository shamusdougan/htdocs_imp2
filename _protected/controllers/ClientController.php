<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use app\models\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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

	    $this->view->params['menuItem'] = 'client';

	    return true; // or false to not run the action
	}






    /**
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['name'=>SORT_ASC],]);
       
        $actionItems[] = ['label'=>'New', 'button' => 'new', 'url'=>"/client/create"];
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'actionItems' => $actionItems,
        ]);
    }

   

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save())
			{
            $get = Yii::$app->request->get();
    		if(isset($get['exit']) && $get['exit'] == 'false' )
    			{
				return $this->redirect(['update', 'id' => $model->id]);
				}
			else{
				return $this->redirect(['index']);
				}
       		} 
       	else {
        	
        	
			$actionItems[] = ['label'=>'Save & Exit', 'button' => 'save', 'url'=>null, 'submit'=> 'client-update-form', 'confirm' => 'Save Client Information and Exit?'];
        	$actionItems[] = ['label'=>'Save', 'button' => 'save', 'overrideAction' =>'/client/create?&exit=false', 'url'=>null, 'submit'=> 'client-update-form', 'confirm' => 'Save Client Information?'];
   
        	
        	
            return $this->render('create', [
                'model' => $model,
                'actionItems' => $actionItems
            ]);
        }
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	$get = Yii::$app->request->get();
    		if(isset($get['exit']) && $get['exit'] == 'false' )
    			{
				return $this->redirect(['update', 'id' => $model->id]);
				}
			else{
				return $this->redirect(['index']);
				}
        } 
        
        
        
        else {
        	
        	
        	$actionItems[] = ['label'=>'Save & Exit', 'button' => 'save', 'url'=>null, 'submit'=> 'client-update-form', 'confirm' => 'Save Client Information and Exit?'];
        	$actionItems[] = ['label'=>'Save', 'button' => 'save', 'overrideAction' =>'/client/update?id='.$id.'&exit=false', 'url'=>null, 'submit'=> 'client-update-form', 'confirm' => 'Save Client Information?'];
        	$actionItems[] = ['label'=>'Cancel', 'button' => 'cancel', 'url'=>'/client/index', 'confirm' => 'Cancel Changes?'];
        
        
        	
            return $this->render('update', [
                'model' => $model, 'actionItems' => $actionItems
            ]);
        }
    }

    /**
     * Deletes an existing Client model.
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
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
