<?php

namespace Application\Interfaces;

interface LogStorage
{

    public function put(string $message);

    public function getAll();

    public function getDate(string $date);

    public function clearAll();

    public function clearDate(string $date);

}