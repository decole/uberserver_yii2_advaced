<?php

namespace common\modules\yandexSkill\services;

use common\modules\yandexSkill\dialogs\DiagnosticDialog;
use common\modules\yandexSkill\dialogs\FireSecureDialog;
use common\modules\yandexSkill\dialogs\HelloDialog;
use common\modules\yandexSkill\dialogs\LampDialog;
use common\modules\yandexSkill\dialogs\PingDialog;
use common\modules\yandexSkill\dialogs\SecureDialog;
use common\modules\yandexSkill\dialogs\StatusDialog;
use common\modules\yandexSkill\dialogs\WateringDialog;
use common\modules\yandexSkill\dialogs\WeatherDialog;

class AliceSkillService
{
    /**
     * @var string | null
     */
    public $text;

    /**
     * @var array | null
     */
    public $message;

    /**
     * @var array
     */
    private $listing;

    public function __construct(?array $request_json)
    {
        $this->text = 'Привет';
        $this->message = $request_json;
        $this->listing = [
            'ping'     => new PingDialog(),
            'hello'    => new HelloDialog(),
            'lamp'     => new LampDialog(),
            'weather'  => new WeatherDialog(),
            'watering' => new WateringDialog(),
            'secure'   => new SecureDialog(),
            'diagnose' => new DiagnosticDialog(),
            'status'   => new StatusDialog(),
            'fire'     => new FireSecureDialog(),
        ];
    }

    public function route(): void
    {
        if (is_array($this->message)) {
            foreach ($this->message as $value)
            {
                if(self::sorter($value)) {
                    break;
                }
            }
        }
        else {
            self::sorter($this->message);
        }
    }

    private function sorter($verb): bool
    {
        foreach ($this->listing as $value) {
            if (in_array( $verb, $value->listVerb() )) {
                $this->text = $value->process($this->message);

                return true;
            }
        }

        return false;
    }
}
