<?php

namespace frontend\components\notify;

use common\models\Notification;
use yii\base\Widget;

class NotifyWidget extends Widget
{
    /**
     * ['messages', 'requests', 'reports']
     *
     * @var array
     */
    public $params;

    public function init()
    {
        parent::init();

        // TODO если нужна будет кастомизация, можно реализовать
        if (empty($this->params)) {
            $this->params = ['messages', 'requests', 'reports'];
        }
    }

    public function run()
    {
        return $this->render('@frontend/components/notify/render', [
            'data' => self::process(),
        ]);
    }

    protected function check($parameter)
    {
        return in_array($parameter, $this->params);
    }

    protected function process()
    {
        $count = 0;
        $result = [];

        foreach ($this->params as $param) {
            if (self::check($param)) {
                $result[$param] = self::extractData($param);
                $count += $result[$param];
                $result['count'] = $count;
            }
        }

        return $result;
    }

    protected function extractData($param)
    {
        switch ($param) {
            case $param = 'messages':
                return (int)Notification::find()->where(['read_at' => null])->count();

                break;
            case $param = 'reports':
            case $param = 'requests':
            default:
                return 0;
                break;
        }
    }
}