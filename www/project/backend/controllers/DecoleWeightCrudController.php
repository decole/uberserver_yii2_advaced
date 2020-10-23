<?php

namespace backend\controllers;

//use backend\jobs\WriteJob;
use Yii;
use common\models\DecoleWeight;
use common\models\DecoleWeightSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DecoleWeightCrudController implements the CRUD actions for DecoleWeight model.
 */
class DecoleWeightCrudController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DecoleWeight models.
     * @return mixed
     */
    public function actionIndex()
    {
//        Yii::$app->queue->push(new WriteJob([
//        Yii::$app->queue->delay(10)->push(new WriteJob([
//            'url' => 'https://www.yiiframework.com/image/logo.svg',
//            'file' => Yii::$app->basePath . '/runtime/image.svg',
//        ]));

//        $module = Yii::$app->getModule('telegram');
////        echo '<pre>';
////        var_dump($module);
////        echo '</pre>';
////        exit();
//        $strapy = $module->params['strapy'];

        $searchModel = new DecoleWeightSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@backend/views/crud/weight/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DecoleWeight model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('@backend/views/crud/weight/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DecoleWeight model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DecoleWeight();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('@backend/views/crud/weight/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DecoleWeight model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('@backend/views/crud/weight/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DecoleWeight model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DecoleWeight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DecoleWeight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DecoleWeight::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Не существует интересующих данных');
    }
}
