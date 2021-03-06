<?php

namespace console\controllers;

use common\services\WateringServise;
use yii\base\Module;
use yii\console\Controller;

class WateringController extends Controller
{
    public $defaultAction = 'info';

    protected WateringServise $service;

    protected string $topicMajor;
    protected string $topicOne;
    protected string $topicTwo;
    protected string $topicThree;

    /**
     * WateringController constructor.
     *
     * @param mixed[][] $config
     */
    public function __construct(string $id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->service = new WateringServise();
        $this->topicMajor = $this->service->topicMajor;
        $this->topicOne = $this->service->topicOne;
        $this->topicTwo = $this->service->topicTwo;
        $this->topicThree = $this->service->topicThree;
    }

    public function actionMajorOn(): void
    {
        $this->service->turnOn($this->topicMajor);
    }

    public function actionMajorOff(): void
    {
        $this->service->turnOff($this->topicMajor);
        sleep(0.5);
        $this->service->turnOff($this->topicOne);
        sleep(0.3);
        $this->service->turnOff($this->topicTwo);
        sleep(0.3);
        $this->service->turnOff($this->topicThree);
        sleep(0.3);
    }

    public function actionOneOn(): void
    {
        $this->service->turnOn($this->topicOne);
        sleep(0.3);
        $this->service->turnOn($this->topicMajor);
        sleep(0.3);
        $this->service->turnOff($this->topicTwo);
        sleep(0.3);
        $this->service->turnOff($this->topicThree);
    }

    public function actionOneOff(): void
    {
        $this->service->turnOff($this->topicMajor);
        sleep(0.5);
        $this->service->turnOff($this->topicOne);
        sleep(0.3);
        $this->service->turnOff($this->topicTwo);
        sleep(0.3);
        $this->service->turnOff($this->topicThree);
        sleep(0.3);
    }

    public function actionTwoOn(): void
    {
        $this->service->turnOn($this->topicTwo);
        sleep(0.5);
        $this->service->turnOn($this->topicMajor);
        sleep(0.3);
        $this->service->turnOff($this->topicOne);
        sleep(0.3);
        $this->service->turnOff($this->topicThree);
    }

    public function actionTwoOff(): void
    {
        $this->service->turnOff($this->topicMajor);
        sleep(0.5);
        $this->service->turnOff($this->topicOne);
        sleep(0.3);
        $this->service->turnOff($this->topicTwo);
        sleep(0.3);
        $this->service->turnOff($this->topicThree);
        sleep(0.3);
    }

    public function actionThreeOn(): void
    {
        $this->service->turnOn($this->topicThree);
        sleep(0.5);
        $this->service->turnOn($this->topicMajor);
        sleep(0.3);
        $this->service->turnOff($this->topicTwo);
        sleep(0.3);
        $this->service->turnOff($this->topicOne);
    }

    public function actionThreeOff(): void
    {
        $this->service->turnOff($this->topicMajor);
        sleep(0.5);
        $this->service->turnOff($this->topicThree);
        sleep(0.3);
        $this->service->turnOff($this->topicOne);
        sleep(0.3);
        $this->service->turnOff($this->topicTwo);
        sleep(0.3);
    }

    public function actionInfo(): void
    {
        $this->stdout('Система автополива' . PHP_EOL);
    }
}
