<?php

namespace common\modules\yandexSkill\dialogs;

class DiagnosticDialog implements AliceInterface
{
    public function listVerb(): array
    {
        return ['диагностика', 'диагностики', 'диагностику'];
    }

    public function process($message): string
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

    public function verb($message): void
    {
    }
}
