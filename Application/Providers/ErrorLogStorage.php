<?php

namespace Application\Providers;

use Application\LogStorage;

class ErrorLogStorage
    extends LogStorage
{

    protected $directory = __DIR__ . '/../../admin/logs/';

}