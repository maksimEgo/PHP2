<?php

namespace src\Builder;

use src\Config\PathConfig;
use Twig\Loader\FilesystemLoader;

class PathBuilder
{
    public static function getFilesystemLoader(PathConfig $config): FilesystemLoader
    {
        $path = self::getPath($config);
        return new FilesystemLoader($path);
    }

    public static function getPath(PathConfig $config): string
    {
        return match ($config) {
            PathConfig::baseTemplatePath => realpath(__DIR__ . '/../../template/') . '/',
            PathConfig::adminTemplatePath => realpath(__DIR__ . '/../../template/admin/') . '/',
        };
    }
}
