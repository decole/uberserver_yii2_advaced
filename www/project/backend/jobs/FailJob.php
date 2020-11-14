<?php

namespace backend\jobs;

class FailJob extends BaseJob
{
    public $type;

    public function run()
    {
        sleep(10);
        10/0;
    }

    public function getName()
    {
        return 'FailJob';
    }
}