<?php

namespace src\Exceptions;

class NotFoundException extends \Exception
{
    const NOT_FOUND_PAGE_ERROR = 404;
    const NOT_FOUND_CONTROLLER = 405;
    const NOT_FOUND_ACTION = 406;
}