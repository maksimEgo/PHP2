<?php

namespace src\Logger;

class LoggerException
{
    private string $logFile;

    public function __construct()
    {
        $this->logFile = __DIR__ . '/../../logs/errorLog.txt';
    }

    public  function log($message): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message" . PHP_EOL;
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }
}