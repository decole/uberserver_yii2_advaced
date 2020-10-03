<?php

namespace frontend\components\relay;

use yii\base\Widget;

class RelayWidget extends Widget
{
    public $relay;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('@frontend/components/relay/render', [
            'swift' => $this->relay,
        ]);
    }
}