<?php

namespace frontend\controllers;

use common\models\HistoryModuleData;
use common\models\ModuleSecureSystem;
use common\models\Weather;
use common\services\MqttService;
use common\services\SecureService;
use DateTime;
use DateTimeZone;
use Throwable;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class ApiController extends Controller
{
    public function __construct($id, $controller, $config = [])
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        parent::__construct($id, $controller, $config);
    }

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

    /**
     * @return mixed
     */
    public function actionMqtt()
    {
        $topic  = Yii::$app->request->get('topic');
        $topics = Yii::$app->request->get('topics');

        if ($topic) {
            return ['payload' => Yii::$app->cache->get($topic)];
        }

        if ($topics) {
            $request = [];
            $list = explode(',', $topics);

            foreach ($list as $topic) {
                $request[$topic] = Yii::$app->cache->get($topic);
            }

            return $request;
        }

        return ['not allowed'];
    }

    public function actionMqttControl()
    {
        $topic = Yii::$app->request->post('topic');
        $payload = Yii::$app->request->post('payload');
        $service = MqttService::getInstance();
        $service->post($topic, $payload);


        $transaction = Yii::$app->db->beginTransaction();

        try {
            $history = new HistoryModuleData();
            $history->topic = $topic;
            $history->payload = $payload;
            $history->save(false);
            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();

            throw $e;
        }

        return ['succes' => true];
    }

    public function actionSecureState()
    {
        $topic  = Yii::$app->request->get('topic');
        $trigger = $this->getTrigger($topic);

        return [
            'state' => Yii::$app->cache->get($topic),
            'trigger' => (bool)$trigger,
        ];
    }

    public function actionSecureCommand()
    {
        $topic  = Yii::$app->request->post('topic');
        $payload  = Yii::$app->request->post('trigger');

        $service = SecureService::getInstance();

        if ($service->triggerChange($topic, $payload)) {
            return [
                'success' => 'Команда  передана успешно',
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

    public function actionChart($date, $topic): array
    {
        // YYYY-MM-DD HH:MI:SS
        $dateStart = $this->dateConvert(date('Y-m-d 00:00:00'));
        $dateEnd = $this->dateConvert(date('Y-m-d 23:59:59'));

        if ($date !== 'current') {
            $dateStart = $this->dateConvert($date . ' 00:00:00');
            $dateEnd = $this->dateConvert($date . ' 23:59:59');
        }

        $mqttData = HistoryModuleData::find()
            ->where(['between', 'created_at', $dateStart, $dateEnd])
            ->andWhere(['topic' => $topic])
            ->orderBy(['created_at'=>'ASC'])
            ->asArray()
            ->all();

        $weatherData = Weather::find()
            ->where(['between', 'created_at', $dateStart, $dateEnd])
            ->orderBy(['created_at'=>'ASC'])
            ->asArray()
            ->all();

        $chart = [];
        $min = '';

        foreach ($mqttData as $mqtt) {
            $timeMqtt = $mqtt['created_at'];

            foreach ($weatherData as $key => $acuweather) {
                $timeAcuweather = $acuweather['created_at'];

                if($timeMqtt > $timeAcuweather ) {
                    $min = $acuweather['temperature'];
                }

                if($timeMqtt < $timeAcuweather) {
                    if(empty($min)) {
                        $min =  $acuweather['temperature'];
                    }

                    $chart[$mqtt['created_at']] = [
                        'mqtt' => (float)$mqtt['payload'],
                        'acuweather' => (float)$acuweather['temperature'],
                    ];

                    break;
                }
            }
        }

        $titles = [];
        $template = [];
        $mqttValues = [];
        $weatherValues = [];

        foreach ($chart as $timestamp => $valueChart) {
            $mqttValues[] = $valueChart['mqtt'];
            $weatherValues[] = $valueChart['acuweather'];
            $titles[] = $this->timestampConvert($timestamp);
        }

        $template['labels'] = array_values($titles);
        $template['datasets'] = [
            [
                'data' => array_values($mqttValues),
                'label' => 'Mqtt sensor',
                'fill' => false,
                'borderColor' => 'rgb(75, 192, 192)',
                'lineTension' => 0.5,
            ],
            [
                'data' => array_values($weatherValues),
                'label' => 'AcuWeather',
                'fill' => false,
                'borderColor' => 'rgb(114, 151, 151)',
                'lineTension' => 0.5,
            ],
        ];

        return $template;
    }

    private function dateConvert($string)
    {
        return (new DateTime($string, new DateTimeZone('Europe/Volgograd')))
            ->getTimestamp();
    }

    private function timestampConvert($timestamp)
    {
        $date = new DateTime("@".$timestamp);
        $date->setTimezone(new DateTimeZone('Europe/Volgograd'));
        return $date->format('H:i:s');
    }
}
