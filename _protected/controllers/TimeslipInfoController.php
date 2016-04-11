<?php

namespace app\controllers;

use Yii;
use app\models\TimeslipInfo;
use app\models\TimeslipInfoSearch;
use app\models\TicketInfo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * TimeslipInfoController implements the CRUD actions for TimeslipInfo model.
 */
class TimeslipInfoController extends Controller
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

    /**
     * Lists all TimeslipInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimeslipInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


	public function actionReview()
	 {
	 	
	 	$this->view->params['menuItem'] = 'timeslip-review';
        $searchModel = new TimeslipInfoSearch();
        $dataProvider = $searchModel->reviewSearch(Yii::$app->request->queryParams);
		//$dataProvider->setPagination(false);
		 
		
		 if (Yii::$app->request->post('hasEditable')) {
		 	
		 	$timeslipID = Yii::$app->request->post('editableKey');
		 	$model = timeslipInfo::findOne($timeslipID);
		 	$out = Json::encode(['output'=>'', 'message'=>'']);
		 	
		 	$row = key($_POST['TimeslipInfo']);
		 	$attributeName = key($_POST['TimeslipInfo'][$row]);
		 	$value = $_POST['TimeslipInfo'][$row][$attributeName];
		 	$model->$attributeName = $value;
		 	
		 	if(!$model->save())
		 		{
				echo Json::encode(['output'=>'', 'message'=>'Error Saving Value']);
				return;
				}
		 	
		 	
		 	echo $out;
		 	return;
		 	}
		
        return $this->render('review', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single TimeslipInfo model.
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
     * Creates a new TimeslipInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TimeslipInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TimeslipInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TimeslipInfo model.
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
     * Finds the TimeslipInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimeslipInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TimeslipInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    
   public function actionModalMaterialsView($id)
	{
		 $timeslip = TimeslipInfo::findOne($id);
		
		
         return $this->renderAjax('_modalMaterialView', [
                'ticket' => $ticket,
            ]);
        
	}
}
