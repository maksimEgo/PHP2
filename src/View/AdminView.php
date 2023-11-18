<?php

namespace src\View;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\ObjectProperties;
use Twig\Environment;

/**
 * Class AdminView
 *
 * This class is responsible for rendering views and managing data passed to them.
 *
 * @package src
 */
class AdminView extends AbstractView
{
    use ObjectProperties;

    public function __construct()
    {
        $loader = PathBuilder::getFilesystemLoader(PathConfig::adminTemplatePath);
        $this->twig = new Environment($loader);
    }

    public function render(string $template): false|string
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
}