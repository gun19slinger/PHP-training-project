<?php
/**
 * Created by PhpStorm.
 * User: NotePad.by
 * Date: 14.12.2016
 * Time: 22:05
 */

namespace Application\Exceptions;


class NotFound extends \Exception
{
    public $message = '404 Not Found';
}