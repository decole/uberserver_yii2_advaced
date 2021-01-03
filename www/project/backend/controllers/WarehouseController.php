<?php

namespace backend\controllers;

use backend\forms\BoxForm;
use backend\forms\RackForm;
use backend\forms\ThingForm;
use backend\services\ThingService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class WarehouseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(): string
    {
        $model = new ThingForm();
        $modelBox = new BoxForm();
        $modelRack = new RackForm();

        if ($model->load(Yii::$app->request->post(), 'ThingForm') && $model->validate()) {
            $service = new ThingService();
            $service->addThing($model);

            return $this->clearForms();
        }

        if ($modelBox->load(Yii::$app->request->post(), 'BoxForm') && $modelBox->validate()) {
            $service = new ThingService();
            $service->addBox($modelBox);

            return $this->clearForms();
        }

        if ($modelRack->load(Yii::$app->request->post(), 'RackForm') && $modelRack->validate()) {
            $service = new ThingService();
            $service->addRack($modelRack);

            return $this->clearForms();
        }

        return $this->render('index', [
            'model' => $model,
            'modelBox' => $modelBox,
            'modelRack' => $modelRack,
        ]);
    }

    private function clearForms(): string
    {
        return $this->render('index', [
            'model' => new ThingForm(),
            'modelBox' => new BoxForm(),
            'modelRack' => new RackForm(),
        ]);
    }
}
