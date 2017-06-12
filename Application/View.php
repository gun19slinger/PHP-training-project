<?php

namespace Application;

use Application\Traits\InaccessiblyProperty;

class View
    implements \Countable
{
    use InaccessiblyProperty;

    public function render($template)
    {
        ob_start();
        foreach ($this->data as $property => $value) {
            $$property = $value;
        }
        include $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

}