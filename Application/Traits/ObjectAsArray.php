<?php

namespace Application\Traits;

trait ObjectAsArray
{
    protected $data = [];

    //ArrayAccess methods
    /**
     * Whether or not an offset exists
     *
     * @param string $offset An offset to check for
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string $offset The offset to assign the value to
     * @param mixed $value The value to set
     */
    public function offsetSet($offset = null, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Unset an offset
     *
     * @param string $offset The offset to unset
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }

    /**
     * Returns the value at specified offset
     *
     * @param string $offset The offset to retrieve
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    // Iterator methods
    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
        reset($this->data);
    }

    /**
     * Return the current element
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * Move forward to next element
     */
    public function next()
    {
        next($this->data);
    }

    /**
     * Checks if current position is valid
     *
     * @return bool
     */
    public function valid()
    {
        return false !== current($this->data);
    }
}