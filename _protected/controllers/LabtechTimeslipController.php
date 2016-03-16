<?php

namespace app\controllers;

use Yii;
use app\models\LabtechTimeslips;
use app\models\LabtechTimeslipsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LabtechTimeslipController implements the CRUD actions for LabtechTimeslips model.
 */
class LabtechTimeslipController extends Controller
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
     * Lists all LabtechTimeslips models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LabtechTimeslipsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LabtechTimeslips model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

  
  	public function actionReviewCompleted()
  	{
		 $this->view->params['menuItem'] = 'timeslip-review';
		$searchModel = new LabtechTimeslipsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		return $this->render('review', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
   

    /**
     * Finds the LabtechTimeslips model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LabtechTimeslips the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabtechTimeslips::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
