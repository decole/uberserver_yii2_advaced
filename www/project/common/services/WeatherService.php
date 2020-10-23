<?php


namespace common\services;

class WeatherService
{
    /**
     * @var string
     */
    private $temp;
    /**
     * @var string
     */
    private $weather_spec;

    /**
     * get AcuWeather parsed information at now
     */
    public function getAcuweather()
    {
        $this->temp = 'not extracted';
        $this->weather_spec = 'not extracted';
        $page    = file_get_contents( 'http://apidev.accuweather.com/currentconditions/v1/291309.json?language=ru-ru&apikey=hoArfRosT1215' );
        $decoded = json_decode( $page, true );
        if ( is_array( $decoded ) ) {
            if ( ! empty( $decoded[0]['Temperature']['Metric']['Value'] ) ) {
                $this->temp = $decoded[0]['Temperature']['Metric']['Value'];
                $this->weather_spec = $decoded[0]['WeatherText'];
            }
        }
        else {
            $this->temp = 'нет данных';
            $this->weather_spec = 'clear';
        }

        return [
            'temperature'  => $this->temp,
            'spec' => $this->weather_spec,
        ];
    }

}
