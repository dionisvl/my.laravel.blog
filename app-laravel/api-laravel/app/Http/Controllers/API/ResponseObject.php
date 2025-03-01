<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

class ResponseObject
{
    public const status_ok = "OK";
    public const status_fail = "FAIL";
    public const code_ok = 200;
    public const code_failed = 400;
    public const code_unauthorized = 403;
    public const code_not_found = 404;
    public const code_error = 500;

    public $status;

    public $code;

    public $messages = array();

    public $result = array();
}
