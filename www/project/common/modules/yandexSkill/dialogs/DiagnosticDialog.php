<?php

namespace common\modules\yandexSkill\dialogs;

class DiagnosticDialog implements AliceInterface
{
    public function __construct()
    {
    }

    public function listVerb()
    {
        return ['диагностика', 'диагностики', 'диагностику'];
    }

    public function process($message)
    {
        // TODO сделать самодиагностику
        //      применить систему тасок. пока не реализовано
//        /** @var Schedule $model */
//        $model = Schedule::find(12);
//        $lastRunDate = new DateTime('NOW');
//        $model->next_run = $lastRunDate->format('Y-m-d H:i:00');
//        $model->interval = null;
//        $model->save();
        return 'Самодиагностика запланирована в менеджере задач. Конечные данные придут в телеграм чат.';
    }

    public function verb($message)
    {
    }
}
