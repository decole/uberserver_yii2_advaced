<?php

namespace common\components;

use yii\base\Event;

class ParamsEvent extends Event
{
    public array $params = [];

    public array $result = [];

    /**
     * @param string $param
     * @param array|null $default
     * @return array
     */
    public function getParam(string $param, $default = null)
    {
        return array_key_exists($param, $this->params) ? $this->params[$param] : $default;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }
}
