<?php

namespace backend\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;

class WriteJob extends BaseObject implements JobInterface
{
    public $url;
    public $file;

    public function execute($queue)
    {
        file_put_contents($this->file, file_get_contents($this->url));
    }
}