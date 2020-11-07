<?php

namespace common\modules\yandexSkill\dialogs;

class StatusDialog implements AliceInterface
{
    /**
     * @var string
     */
    public $text;

    public function __construct()
    {
        $this->text = 'Команда не распознана';
    }

    public function listVerb()
    {
        return ['статус', 'статуса', 'статусу'];
    }

    public function process($message)
    {
        return 'Общий статус - пока неизвестен. Не разработан алгоритм диагностики.';
    }

    public function verb($message)
    {
    }
}
