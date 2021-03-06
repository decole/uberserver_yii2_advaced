<?php

namespace console\controllers;

use common\services\TelegramService;
use yii\console\Controller;
use yii\helpers\Console;

class TelegramController extends Controller
{
    /**
     * @var mixed
     */
    public $message;

    public function options($actionID)
    {
        return ['message'];
    }

    public function optionAliases()
    {
        return ['m' => 'message'];
    }

    public function actionBot(): void
    {
        $bot = TelegramService::getInstance();

        while (true) {
            $bot->getUpdates();
            sleep(7);
        }

        exit();
    }

    public function actionSend(): void
    {
        $service = TelegramService::getInstance();

        $message = $this->message;
        $service->sendDecole($message);

        $this->stdout("send message from Decole " . $this->message . PHP_EOL, Console::BOLD);
        exit();
    }
}
