<?php


namespace common\services\mqtt\ValidateProcessor;

interface DeviceInterface
{
    /**
     * Передача массива топиков
     *
     * @return array
     */
    public function getTopics();

    /**
     * Создание кэшированных данных
     *
     * @return array
     */
    public function createDataset();

    /**
     * Анализ приходящих сообщений на вхождение в допустимые прределы**
     *
     * @param $message
     * @return mixed
     */
    public function deviceValidate($message);

    /**
     * Функция проверки является ли топик данным видом устройств
     *
     * @param $topic
     * @return mixed
     */
    public function isSensor($topic);
}
