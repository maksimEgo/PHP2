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
            PathConfig::publicIndexPage => realpath(__DIR__ . '/../../template/'),
            PathConfig::adminIndexPage => realpath(__DIR__ . '/../../template/admin/index.php'),
            PathConfig::adminActionEditPage => realpath(__DIR__ . '/../../template/admin/action/edit.php'),
            PathConfig::adminActionAddPage => realpath(__DIR__ . '/../../template/admin/action/add.php')
        };
    }
}
