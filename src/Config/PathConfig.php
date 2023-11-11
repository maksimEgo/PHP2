<?php

namespace src\Config;

enum PathConfig
{
    case baseTemplatePath;
    case adminTemplatePath;

    public function getPath(): string
    {
        return match ($this) {
            PathConfig::baseTemplatePath => realpath(__DIR__ . '/../../template/') . '/',
            PathConfig::adminTemplatePath => realpath(__DIR__ . '/../../template/admin/') . '/',
        };
    }
}
