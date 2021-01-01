<?php

namespace common\modules\yandexSkill\dialogs;

interface AliceInterface
{
    public function listVerb(): array;

    /**
     * Главный метод вывода данных по диалогу
     */
    public function process($message): string;

    /**
     * Слова тригеры и их процессы
     * @param $message
     */
    public function verb($message): void;
}
