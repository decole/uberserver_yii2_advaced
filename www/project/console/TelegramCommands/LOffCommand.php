<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use common\services\MqttService;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;

/**
 * User "/weather" command
 *
 * Get weather info for any place.
 * This command requires an API key to be set via command config.
 */
class LOffCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'loff';

    /**
     * @var string
     */
    protected $description = 'Выключить лампу';

    /**
     * @var string
     */
    protected $usage = '/loff';

    /**
     * @var string
     */
    protected $version = '0.0.1';

    /**
     * Command execute method
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute()
    {
        $message      = $this->getMessage();
        $chat_id      = $message->getChat()->getId();

        $service = MqttService::getInstance();
        $service->post('margulis/lamp01', 'off');

        $data = [
            'chat_id' => $chat_id,
            'text'    => 'Лампа в пристройке выключена',
        ];

        return Request::sendMessage($data);
    }
}