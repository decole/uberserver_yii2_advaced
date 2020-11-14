<?php

namespace backend\jobs;

class WriteJob extends BaseJob
{
    public $url;
    public $file;

    public function run()
    {
        file_put_contents($this->file, file_get_contents($this->url));
    }

    public function getName()
    {
        return 'WriteJob';
    }
}