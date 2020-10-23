<?php

namespace backend\controllers;

use common\services\mqtt\DeviceService;
use common\models\ModuleRelay;
use common\models\ModuleRelaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ModuleRelayCrudController implements the CRUD actions for ModuleRelay model.
 */
class ModuleRelayCrudController extends Controller
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
     * Lists all ModuleRelay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleRelaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@backend/views/crud/relays/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleRelay model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('@backend/views/crud/relays/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ModuleRelay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleRelay();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            self::updateCache();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('@backend/views/crud/relays/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModuleRelay model.
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

        return $this->render('@backend/views/crud/relays/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ModuleRelay model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        self::updateCache();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ModuleRelay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleRelay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleRelay::findOne($id)) !== null) {
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
        Yii::$app->cache->delete($service->relay_model);
        Yii::$app->cache->delete($service->relay_list);
    }
}
