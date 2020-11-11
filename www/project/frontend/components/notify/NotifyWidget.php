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
        if (empty($param)) {
            $this->params = 'messages';
        }
    }

    public function run()
    {
        $notify = (int)Notification::find()->where(['read_at' => null])->count();
        $requests = (int)0;
        $reports = (int)0;
        $count = $notify + $requests + $reports;

        return $this->render('@frontend/components/notify/render', [
            'count'    => $count,
            'messages' => $notify,
            'requests' => $requests,
            'reports'  => $reports,
        ]);
    }
}