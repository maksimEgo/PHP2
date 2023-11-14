<?php

namespace src\Builder;

use src\Config\PathConfig;

class PathBuilder
{
    public static function getPath(PathConfig $config): string
    {
        return match ($config) {
            PathConfig::baseTemplatePath => realpath(__DIR__ . '/../../template/') . '/',
            PathConfig::adminTemplatePath => realpath(__DIR__ . '/../../template/admin/') . '/',
        };
    }
}