<?php
namespace frontend\controllers;

use common\models\HistoryFireSecureData;
use common\models\HistoryModuleData;
use common\models\HistorySecureData;
use common\models\LoginForm;
use common\models\ModuleRelay;
use common\models\ModuleSensor;
use common\models\Notification;
use common\models\Schedule;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @return mixed[][]
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
     * @return string[][]
     */
    public function actions(): array
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

    public function actionIndex(): string
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }

        return $this->render('index');
    }

    public function actionNotify(): string
    {
        $refresh = false;

        if (Yii::$app->request->post()['clear'] === 'all') {
            $time = time();
            $refresh = true;
            Notification::updateAll(['read_at' => $time], ['read_at' => null]);

            $this->redirect('notify');
        }

        $query = Notification::find()->where(['read_at' => null]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('notify', [
            'dataProvider' => $provider,
            'refreshed' => $refresh,
        ]);
    }

    public function actionGreenhouse(): string
    {
        $sensors = ModuleSensor::find()
            ->where(['topic' => 'greenhouse/temperature'])
            ->asArray()
            ->all();

        return $this->render('greenhouse', [
            'sensors' => $sensors,
        ]);
    }

    public function actionTestIcons(): string
    {
        return $this->render('icons');
    }

    public function actionLogin(): string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        // для авторизации исполбзуется свой шаблон main-login
        $this->layout = 'main-login';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): string
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAllData(): string
    {
        $sensors = ModuleSensor::find()->asArray()->all();
        $relays = ModuleRelay::find()->asArray()->all();

        return $this->render('all-data', [
            'sensors' => $sensors,
            'relays' => $relays,
        ]);
    }

    public function actionMargulis(): string
    {
        $sensors = ModuleSensor::find()
            ->where(['topic' => 'margulis/temperature'])
            ->orWhere(['topic' => 'margulis/humidity'])
            ->asArray()
            ->all();

        $relays = ModuleRelay::find()
            ->where(['topic' => 'margulis/lamp01'])
            ->asArray()
            ->all();

        return $this->render('margulis', [
            'sensors' => $sensors,
            'relays' => $relays,
        ]);
    }

    public function actionSecure(): string
    {
        $query = HistorySecureData::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('secure', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionFireSecure(): string
    {
        $query = HistoryFireSecureData::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('fire-secure', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionWatering(): string
    {
        $watering = ModuleRelay::find()->where(['type' => 7])->asArray()->all();
        $waterTopics = ArrayHelper::getColumn($watering, 'topic');

        $query = HistoryModuleData::find()
            ->select(['history.topic', 'history.payload', 'history.created_at', 'relay.name'])
            ->alias('history')
            ->where(['history.topic' => $waterTopics])
            ->innerJoin(['relay' => ModuleRelay::tableName()], 'history.topic = relay.topic')
            ->orderBy(['history.created_at' => SORT_DESC])
            ->asArray()->all();

        $provider = new ArrayDataProvider([
            'allModels' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        $neededTopics = [
            'water/major' => 'watering/major-off',
            'water/1' => 'watering/one-on',
            'water/2' => 'watering/two-on',
            'water/3' => 'watering/three-on',
        ];

        $schedule = Schedule::find()
            ->where(['command' => array_values($neededTopics)])
            ->asArray()
            ->orderBy(['next_run' => SORT_ASC])
            ->all();

        $maxKeyId = count($schedule) - 1;

        $scenario = [];
        $scenario['water/major']['start'] = $schedule[0]['next_run'];
        $scenario['water/major']['end'] = $schedule[$maxKeyId]['next_run'];

        $schedule = ArrayHelper::index($schedule, 'command');

        $scenario['water/1']['start'] = $schedule[$neededTopics['water/1']]['next_run'];
        $scenario['water/1']['end'] = $schedule[$neededTopics['water/2']]['next_run'];

        $scenario['water/2']['start'] = $schedule[$neededTopics['water/2']]['next_run'];
        $scenario['water/2']['end'] = $schedule[$neededTopics['water/3']]['next_run'];

        $scenario['water/3']['start'] = $schedule[$neededTopics['water/3']]['next_run'];
        $scenario['water/3']['end'] = $schedule[$neededTopics['water/major']]['next_run'];

        $relays = ModuleRelay::find()
            ->where(['topic' => array_keys($neededTopics)])
            ->asArray()
            ->all();

        return $this->render('watering', [
            'dataProvider' => $provider,
            'watering' => $watering,
            'scenario' => $scenario,
            'sensor' => ArrayHelper::index($relays, 'topic'),
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash(
                'success',
                'Thank you for registration. Please check your inbox for verification email.'
            );

            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash(
                'error',
                'Sorry, we are unable to reset password for the provided email address.'
            );
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @return mixed
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function actionResetPassword(string $token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail(string $token): yii\web\Response
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');

                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');

        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash(
                'error',
                'Sorry, we are unable to resend verification email for the provided email address.'
            );
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model,
        ]);
    }
}
