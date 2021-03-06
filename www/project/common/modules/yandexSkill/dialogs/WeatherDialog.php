<?php

namespace common\modules\yandexSkill\dialogs;

use common\services\WeatherService;

class WeatherDialog implements AliceInterface
{
    /**
     * @var string
     */
    public $text;

    public function __construct()
    {
        $this->text = 'У природы нет плохой погоды';
    }

    public function listVerb(): array
    {
        return ['погода', 'погоды', 'погоду'];
    }

    public function process($message): string
    {
        self::verb($message);

        return $this->text;
    }

    public function verb($message): void
    {
        $weather    = (new WeatherService())->getAcuweather();
        $temp       = (int)$weather['temperature'];
        $spec       = $weather['spec'];
        $this->text = 'Температура: ' . $temp . ' градусов, ' . $spec;
    }
}
