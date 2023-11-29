<?php

namespace src\Exceptions;

class MultiException extends \Exception
{
    private array $exceptions = [];

    public function add(\Exception $exception): void
    {
        $this->exceptions[] = $exception;
    }

    public function empty(): bool
    {
        return empty($this->exceptions);
    }

    public function all(): array
    {
        return $this->exceptions;
    }
}