<?php

namespace src\View;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\ObjectProperties;
use Twig\Environment;


class AbstractView
{
    /**
     * Include trait for dynamic property handling.
     */
    use ObjectProperties;

    protected Environment $twig;
    private int $position = 0;

    public function __construct()
    {
        $loader = PathBuilder::getFilesystemLoader(PathConfig::baseTemplatePath);
        $this->twig = new Environment($loader);
    }

    /**
     * Renders a view template.
     *
     * This method takes a view template and renders it, injecting any data that has been set on the AdminView object.
     * The rendered content is then returned as a string.
     *
     * @param string $template The path to the view template file.
     * @return false|string The rendered view content or false on failure.
     */
    public function render(string $template): false|string
    {
        return $this->twig->render($template, $this->data);
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