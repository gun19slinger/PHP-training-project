<?php

namespace Application;

use Application\Interfaces\LogStorage as Storage;

abstract class LogStorage
    implements Storage
{

    protected $file;
    protected $filename;
    protected $directory;

    public function __construct()
    {
        $date = date('d_m_Y');
        $this->filename = 'log_' . $date . '.log';
        $this->file = $this->directory . $this->filename;
    }

    public function put(string $message)
    {
        $message = $message . "\n";
        error_log($message, 3, $this->file);
    }

    public function getAll()
    {
        $array = [];
        $dir = opendir($this->directory);
        while ($file = readdir($dir)) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $array[$file] = file_get_contents($this->directory . $file);
        }
        closedir($dir);
        return $array;
    }

    public function getDate(string $date)
    {
        $date = 'log_' . $date . '.log';
        $result = 'Записей за такую дату нет';
        if (isset($this->getAll()[$date])) {
            $result = $this->getAll()[$date];
        }
        return $result;
    }

    public function clearAll()
    {
        $dir = opendir($this->directory);
        while ($file = readdir($dir)) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            unlink($this->directory . $file);
        }
        closedir($dir);
    }

    public function clearDate(string $date)
    {
        $date = 'log_' . $date . '.log';
        if (isset($this->getAll()[$date])) {
            unlink($this->directory . $date);
        }
    }

    public function sendLogOnMail()
    {
        $message = new MySwiftMailer(
            'There is some problems with profithomework.local!',
            'We catch an Exception. To get more information open the file.',
            $this->file
        );
        return $message->send();
    }

}