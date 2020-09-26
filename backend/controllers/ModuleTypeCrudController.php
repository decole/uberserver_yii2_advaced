<?php

namespace backend\controllers;

use common\services\mqtt\DeviceService;
use Yii;
use common\models\ModuleType;
use common\models\ModuleTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModuleTypeCrudController implements the CRUD actions for ModuleType model.
 */
class ModuleTypeCrudController extends Controller
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
     * Lists all ModuleType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@backend/views/crud/types/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('@backend/views/crud/types/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ModuleType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            self::updateCache();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('@backend/views/crud/types/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModuleType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            self::updateCache();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('@backend/views/crud/types/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ModuleType model.
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
     * Finds the ModuleType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Обновление кэша для MqttService
     */
    private static function updateCache(): void
    {
        $service = DeviceService::getInstance();

        Yii::$app->cache->delete($service->sensor_model);
        Yii::$app->cache->delete($service->sensor_list);

        Yii::$app->cache->delete($service->relay_model);
        Yii::$app->cache->delete($service->relay_list);

        Yii::$app->cache->delete($service->leakage_model);
        Yii::$app->cache->delete($service->leakage_list);

        Yii::$app->cache->delete($service->secure_model);
        Yii::$app->cache->delete($service->secure_list);

        Yii::$app->cache->delete($service->fireSecure_model);
        Yii::$app->cache->delete($service->fireSecure_list);
    }
}
