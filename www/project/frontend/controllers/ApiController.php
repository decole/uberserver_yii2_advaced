<?php

namespace frontend\controllers;

use common\services\MqttService;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Site controller
 */
class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login'],
                'rules' => [
                    [
                        'actions' => ['mqtt-control'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['mqtt'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'mqtt-control' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionMqtt()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $topic  = Yii::$app->request->get('topic');
        $topics = Yii::$app->request->get('topics');

        if ($topic) {
            return ['payload' => Yii::$app->cache->get($topic)];
        }
        if ($topics) {
            return $topics;
        }

        return ['not allowed'];
    }

    public function actionMqttControl()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $topic = Yii::$app->request->post('topic');
        $payload = Yii::$app->request->post('payload');
        $service = MqttService::getInstance();
        $service->post($topic, $payload);

        return ['succes' => true];
    }
}
