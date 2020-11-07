<?php

namespace common\modules\yandexSmartHome\actions;

use yii\base\Action;
use yii\web\Response;
use Yii;

class BaseAction extends Action
{
    /**
     * @var array|string|null
     */
    public $request_id;

    public function __construct($id, $controller, $config = [])
    {
        $headers = Yii::$app->request->getHeaders();
        $this->request_id =  $headers->get('X-Request-Id');

        Yii::$app->response->format = Response::FORMAT_JSON;

        parent::__construct($id, $controller, $config);
    }
}
