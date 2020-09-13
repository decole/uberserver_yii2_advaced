<?php


namespace common\traits;


use Yii;

trait instance
{
    /**
     * @var array
     */
    protected static $instances;

    public static function getInstance(): self
    {
        $class = static::class;

        if (!isset(static::$instances[$class])) {
            static::$instances[$class] = Yii::createObject(static::class);
        }

        return static::$instances[$class];
    }
}