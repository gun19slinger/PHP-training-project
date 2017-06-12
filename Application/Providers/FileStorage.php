<?php

namespace Application\Providers;

use Application\LogStorage;

class FileStorage
    extends LogStorage
{

    protected $directory = __DIR__ . '/../../admin/files/';

    public function put(string $message)
    {
        $message = $message . "\n";
        file_put_contents($this->file, $message, FILE_APPEND);
    }

}