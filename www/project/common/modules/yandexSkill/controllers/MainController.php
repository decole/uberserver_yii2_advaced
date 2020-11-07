<?php

namespace common\modules\yandexSkill\controllers;

use common\modules\yandexSkill\services\AliceSkillService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class MainController extends Controller
{
    /**
     * @var bool
     */
    private $validUser;

    /**
     * @var bool
     */
    private $isAdmin;

    /**
     * @var null
     */
    private $user_id;

    /**
     * @var bool
     */
    private $end_session;

    /**
     * @var null
     */
    private $message_id;

    /**
     * @var null
     */
    private $session_id;

    /**
     * @var null
     */
    private $skill_id;

    /**
     * @var bool
     */
    private $new;

    /**
     * @var AliceSkillService
     */
    private $dialog;

    public function __construct($id, $module, $config = [])
    {
        $this->enableCsrfValidation = false;
        parent::__construct($id, $module, $config);

        $this->message_id = null;
        $this->session_id = null;
        $this->skill_id = null;
        $this->user_id = null;
        $this->new = false;
        $this->end_session = false;
        $this->validUser  = false;
        $this->isAdmin = false;
    }

    public function actionIndex(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = json_decode(file_get_contents('php://input'));
        $session = $request->session;

        $this->message_id = $session->message_id;
        $this->session_id = $session->session_id;
        $this->skill_id = $session->skill_id;
        $this->user_id = $session->user_id;
        $this->new = $session->new;

        $this->process($request->request->nlu->tokens);

        return [
            'response' =>
                [
                    'text'        => $this->dialog->text,
                    'tts'         => $this->dialog->text,
                    'end_session' => $this->end_session,
                ],
            'session' =>
                [
                    'session_id'  => $this->session_id,
                    'message_id'  => $this->message_id,
                    'user_id'     => $this->user_id,
                ],
            'version' => '1.0',
        ];
    }

    private function process(?array $request_json): void
    {
        $this->dialog = new AliceSkillService($request_json);
        $this->dialog->route();
    }
}
