<?php

namespace src\Exceptions;

class DataBaseException extends \Exception
{
    const CONNECTION_ERROR = 1001;
    const QUERY_ERROR = 1002;
    const EXECUTE_ERROR = 1003;
}