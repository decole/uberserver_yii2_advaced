<?php

namespace frontend\controllers;

use common\models\ModuleSecureSystem;
use common\services\mqtt\DeviceService;
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
                        'actions' => [
                            'mqtt-control',
                            'mqtt',
                            'secure-state',
                            'secure-command',
                        ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'mqtt-control' => ['post'],
//                    'secure-command' => ['post'],
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
            return $topics; // TODO доработать метод
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

    public function actionSecureState()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $topic  = Yii::$app->request->get('topic');
        $trigger = $this->getTrigger($topic);

        return [
            'state' => Yii::$app->cache->get($topic),
            'trigger' => (bool)$trigger,
        ];
    }

    public function actionSecureCommand()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $topic  = Yii::$app->request->post('topic');
        $payload  = Yii::$app->request->post('trigger');
        $model = ModuleSecureSystem::findOne(['topic' => $topic]);

        if ($model) {
            $payload == 'on' ? $trigger = true : $trigger = false;
            $model->trigger = $trigger;

            if ($model->update(false)) {
                $service = DeviceService::getInstance();
                Yii::$app->cache->delete($service->secure_model);
                Yii::$app->cache->delete($service->secure_list);

                return [
                    'success' => 'Команда  передана успешно',
                ];
            }

            return [
                'error' => 'Датчик не может сохранить свое новое состояние!',
            ];
        }

        return [
            'error' => 'Не могу передать команду датчику!',
        ];
    }

    public function getTrigger($topic)
    {
        return (int)ModuleSecureSystem::findOne(['topic' => $topic])->trigger;
    }
}
