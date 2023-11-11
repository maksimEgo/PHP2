<?php

namespace src\View;

use src\ObjectProperties;

/**
 * Class View
 *
 * This class is responsible for rendering views and managing data passed to them.
 *
 * @package src
 */
class View implements \Countable, \Iterator
{
    /**
     * Include trait for dynamic property handling.
     */
    use ObjectProperties;

    private int $position = 0;

    /**
     * Renders a view template.
     *
     * This method takes a view template and renders it, injecting any data that has been set on the View object.
     * The rendered content is then returned as a string.
     *
     * @param string $template The path to the view template file.
     * @return false|string The rendered view content or false on failure.
     */
    public function render($template): false|string
    {
        foreach ($this->data as $name => $value) {
            $$name = $value;
        }

        ob_start();
        include $template;
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function current(): mixed
    {
        return $this->data[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}