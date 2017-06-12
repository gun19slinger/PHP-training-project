<?php

namespace Application;

use Application\Providers\DBStorage;
use Application\Providers\ErrorLogStorage;
use Application\Providers\FileStorage;

class Logger
{

    public $provider;

    public function __construct(string $string = 'Log')
    {
        switch ($string) {
            case 'Log':
                $this->provider = new ErrorLogStorage();
                break;
            case 'File':
                $this->provider = new FileStorage();
                break;
            case 'DB':
                $this->provider = new DBStorage();
                break;
            default:
                break;
        }
    }

}