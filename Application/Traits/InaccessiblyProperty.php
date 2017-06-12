<?php

namespace Application\Traits;

trait InaccessiblyProperty
{

    /**
     * Data
     *
     * @access private
     * @var array
     */
    private $data = [];

    /**
     * Whether or not an data exists by key
     *
     * @param string $name An data key to check for
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * The value to set
     *
     * @param string $name The data key to assign the value to
     * @param mixed $value The value to set
     * @return void
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Get a data by key
     *
     * @param string $name The key data to retrieve
     * @return mixed
     */
    public function __get($name)
    {
        if ($this->__isset($name)) {
            return $this->data[$name];
        }
        return null;
    }

}