<?php

namespace frontend\components\relay;

use yii\base\Widget;

class RelayWidget extends Widget
{
    public $relay;

    public $template = 'full';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->template === 'only-buttons') {
            return $this->render('@frontend/components/relay/only-buttons', [
                'swift' => $this->relay,
            ]);
        }

        return $this->render('@frontend/components/relay/render', [
            'swift' => $this->relay,
        ]);
    }
}