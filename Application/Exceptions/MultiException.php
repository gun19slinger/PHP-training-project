<?php

namespace Application\Exceptions;

use Application\Traits\ObjectAsArray;

class MultiException
    extends \Exception
    implements \ArrayAccess, \Iterator
{
    use ObjectAsArray;
    
    public function isEmpty()
    {
        return empty($this->data);
    }
    
}