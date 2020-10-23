<?php
namespace common\services;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use GuzzleHttp\Client;
use Yii;
use yii\base\Controller;

class TelegramService extends Controller
{
    /**
     * @var array
     */
    protected static $instances;

    public static function getInstance(): self
    {
        $class = static::class;

        if (!isset(static::$instances[$class])) {
            static::$instances[$class] = Yii::createObject(static::class);
        }

        return static::$instances[$class];
    }

    /**
     * @var
     */
    private $bot_username;

    /**
     * @var
     */
    private $token;

    /**
     * @var
     */
    public  $telegram;

    /**
     * @var
     */
    public  $users;

    /**
     * @var
     */
    private $commands_paths;

    /**
     * @var
     */
    private $admin_users;

    /**
     * @var
     */
    private $mysql_credentials;

    /**
     * @var
     */
    private $hookUrl;

    /**
     * TelegramHelper constructor.
     *
     * https://github.com/php-telegram-bot/core/issues/822
     *
     * ```
     *
     *  $telegram = new Telegram(...);
     *  ...
     *  Request::setClient(new Client([
     *      'base_uri' => 'https://api.telegram.org',
     *      'proxy'    => 'socks5://127.0.0.1:9050',
     *  ]));
     *  ...
     *  $telegram->handle();
     *
     * ```
     */

    public function __construct($config = [])
    {
        parent::__construct($this->id, $this->module, $config);

        $this->hookUrl = Yii::$app->params['TELEGRAM_HOOK_URL'];
        $this->bot_username = Yii::$app->params['TELEGRAM_BOT_NAME'];
        $this->token = Yii::$app->params['TELEGRAM_BOT_TOKEN'];
        $this->users = [
            'decole' => Yii::$app->params['DECOLE_TELEGRAM_ID'],
            'panterka' => Yii::$app->params['PANTERKA_TELEGRAM_ID'],
        ];
        $this->admin_users = [
            Yii::$app->params['DECOLE_TELEGRAM_ID'],
        ];
        $this->commands_paths = [
            __DIR__ . '/../../console/TelegramCommands/',
        ];

        $this->mysql_credentials = [
            'host'     => Yii::$app->params['TG_DB_HOST'],
            'user'     => Yii::$app->params['TG_DB_USERNAME'],
            'password' => Yii::$app->params['TG_DB_PASSWORD'],
            'database' => Yii::$app->params['TG_DB_DATABASE'],
        ];

        try {
            $this->telegram = new Telegram($this->token, $this->bot_username);
            Request::setClient(new Client([
                'base_uri' => 'https://api.telegram.org',
                //'proxy'   => Yii::$app->params['SOCKS5_PROXY_TELEGRAM'],
            ]));
        } catch (TelegramException $e) {
            $this->telegram = false;
        }
    }

    /**
     * Using on commands and controllers
     *
     * @param $text
     * @param $chatId
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function send($text, $chatId)
    {
        try {
            return Request::sendMessage([
                'chat_id' => $chatId,
                'text'    => $text,
            ]);
        } catch (TelegramException $e) {
            return $e;
        }
    }

    /**
     * Send by specific user
     *
     * @param $text
     * @param string $user
     * @return bool|mixed
     * @throws TelegramException
     */
    public function sendByUser($text, $user = 'decole')
    {
        if(empty($this->users[$user])) {
            return false;
        }

        return $this->send($text, $this->users[$user]);

    }

    /**
     * Sending by Decole
     *
     * @param $text
     * @param string $user
     * @return bool
     * @throws TelegramException
     */
    public function sendDecole($text, $user = 'decole')
    {
        return $this->sendByUser($text, $user);

    }


    /**
     * Update new messages
     */
    public function getUpdates()
    {
        try {
            /** @var Telegram $telegram */
            $telegram = $this->telegram;
            $telegram->setCommandConfig('weather', ['owm_api_key' => 'hoArfRosT1215']);
            $telegram->addCommandsPaths($this->commands_paths);
            $telegram->enableAdmins($this->admin_users);
            $telegram->useGetUpdatesWithoutDatabase();
            $telegram->enableLimiter();
            $server_response = $telegram->handleGetUpdates();
            if ($server_response->isOk()) {
//                $update_count = count($server_response->getResult());
//                Log::channel('telegramBot')->info(
//                    date('Y-m-d H:i:s', time())
//                    . ' - Processed '
//                    . $update_count
//                    . ' updates'
//                );
            } else {
                // TODO прикрутить логи
                // Log::channel('telegramBot')->info($server_response->printError());
            }
        } catch (TelegramException $e) {
            echo $e->getMessage();
        }
    }
}