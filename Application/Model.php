<?php

namespace Application;

abstract class Model
{

    const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }

    public static function findAllRevers()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC',
            [],
            static::class
        );
    }

    public static function findAllLineByLine()
    {
        $db = Db::instance();
        foreach ($db->queryEach(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        ) as $line) {
            yield $line;
        }
    }

    public static function findById(int $id)
    {
        $db = Db::instance();
        $record = $db->query(
            'SELECT * FROM '
            . static::TABLE
            . ' WHERE id = ?',
            [(int)$id],
            static::class
        );
        if (!empty($record)) {
            return $record[0];
        } else {
            return false;
        }
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function insert()
    {
        $columns = [];
        $values = [];
        foreach ($this as $key => $val) {
            if ('id' === $key) {
                continue;
            }
            $columns[] = $key;
            $values[':' . $key] = $val;
        }

        $sql = 'INSERT INTO ' . static::TABLE .
            '(' . implode(',', $columns) . ')
            VALUES 
            (' . implode(',', array_keys($values)) . ')';

        $db = Db::instance();
        $db->execute($sql, $values);
        $this->id = $db->getLastInsertId();

    }

    public function update()
    {
        $values = [];
        $param = [];
        foreach ($this as $key => $val) {
            if ('id' === $key) {
                continue;
            }
            $values[':' . $key] = $val;
            $param[] = $key . ' = ' . ':' . $key;
        }

        $sql = 'UPDATE ' . static::TABLE .
            ' SET ' . implode(', ', $param) .
            ' WHERE id = ' . $this->id;

        $db = Db::instance();
        $db->execute($sql, $values);

    }

    public function save()
    {
        if (!$this->isNew()) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE .
            ' WHERE id = ' . $this->id;

        $db = Db::instance();
        $db->execute($sql);
    }

}