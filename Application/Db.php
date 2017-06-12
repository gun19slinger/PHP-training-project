<?php

namespace Application;

use Application\Exceptions\Db as ExDb;

class Db
{
    use Singleton;

    protected $dbh;

    protected function __construct()
    {
        try {
            $config = Config::instance();
            $data = $config->getData('profit');
            $this->dbh = new \PDO(
                $data['driver'] . ':host=' . $data['host'] . ';dbname=' . $data['dbname'],
                $data['user_name'],
                $data['user_password']
            );
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new ExDb('Возникла ошибка соединения с базой данных: ' . $e->getMessage());
        }

    }

    public function execute(string $sql, array $array = [])
    {
        $sth = $this->dbh->prepare($sql);
        try {
            if (!empty($array)) {
                return $sth->execute($array);
            } else {
                return $sth->execute();
            }
        } catch (\PDOException $e) {
            throw new ExDb('Возникла ошибка при обращении к базе данных: ' . $e->getMessage());
        }
    }

    public function query(string $sql, array $array = [], string $class = '')
    {
        try {
            $sth = $this->dbh->prepare($sql);
            if (!empty($array)) {
                $result = $sth->execute($array);
            } else {
                $result = $sth->execute();
            }
            if (false !== $result) {
                if ('' !== $class) {
                    $data = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
                } else {
                    $data = $sth->fetchAll(\PDO::FETCH_COLUMN, 1);
                }
            }
            return $data;
        } catch (\PDOException $e) {
            throw new ExDb('Возникла ошибка при обращении к базе данных: ' . $e->getMessage());
        }
    }

    public function queryEach(string $sql, array $array = [], string $class = '')
    {
        try {
            $sth = $this->dbh->prepare($sql);
            if (!empty($array)) {
                $result = $sth->execute($array);
            } else {
                $result = $sth->execute();
            }
            if (false !== $result) {
                if ('' !== $class) {
                    $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
                    while ($data = $sth->fetch()) {
                        yield $data;
                    }
                } else {
                    while ($data = $sth->fetch(\PDO::FETCH_ASSOC)) {
                        yield $data;
                    }
                }
            }
        } catch (\PDOException $e) {
            throw new ExDb('Возникла ошибка при обращении к базе данных: ' . $e->getMessage());
        }
    }

    public function getLastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}