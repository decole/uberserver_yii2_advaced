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
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class LOnCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'lon';

    /**
     * @var string
     */
    protected $description = 'Включить лампу';

    /**
     * @var string
     */
    protected $usage = '/lon';

    /**
     * @var string
     */
    protected $version = '0.0.1';

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message      = $this->getMessage();
        $chat_id      = $message->getChat()->getId();

        $service = new MqttService;
        $service->post('margulis/lamp01', 'on');
        $service->disconnect();

        $data = [
            'chat_id' => $chat_id,
            'text'    => 'Лампа в пристройке включена',
        ];

        return Request::sendMessage($data);
    }
}
