<?php

namespace Application\Providers;

use Application\Db;
use Application\LogStorage;

class DBStorage
    extends LogStorage
{
    
    protected $filename;

    public function __construct()
    {
        $db = Db::instance();
        $date = date('d_m_Y');
        $this->filename = 'log_' . $date;
        $db->execute(
            'CREATE TABLE IF NOT EXISTS ' . $this->filename .
            ' (id serial,
            log text NOT NULL)'
        );
    }

    public function put(string $message)
    {
        $value[] = $message;
        $db = Db::instance();
        $sql =  'INSERT INTO ' . $this->filename .
                ' (log) 
                VALUES 
                (?)';
        $db->execute($sql, $value);
    }

    public function getTables()
    {
        $db = Db::instance();
        $tables = $db->query(
            'SHOW TABLES LIKE \'log_%\''
        );
        return $tables;
    }

    public function getAll()
    {
        $db = Db::instance();
        $tables = $this->getTables();
        $logs = [];
        foreach ($tables as $table) {
            $logs[$table] = $db->query(
                'SELECT log FROM ' . $table
            );
        }
        return $logs;
    }

    public function getDate(string $date)
    {
        $date = 'log_' . $date;
        $logs = $this->getAll();
        foreach ($logs as $key => $val) {
            if ($date === $key) {
                return $val;
            }
        }
    }

    public function clearAll()
    {
        $db = Db::instance();
        $tables = $this->getTables();
        foreach ($tables as $table) {
            $db->execute(
                'DROP TABLE ' . $table
            );
        }
    }

    public function clearDate(string $date)
    {
        $db = Db::instance();
        $date = 'log_' . $date;
        $logs = $this->getAll();
        foreach ($logs as $key => $val) {
            if ($date === $key) {
                $db->execute(
                    'DROP TABLE ' . $key
                );
            }
        }
    }

}