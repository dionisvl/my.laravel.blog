<?php


namespace App\Http\Controllers\API;


class ResponseObject
{
    const status_ok = "OK";
    const status_fail = "FAIL";
    const code_ok = 200;
    const code_failed = 400;
    const code_unauthorized = 403;
    const code_not_found = 404;
    const code_error = 500;

    public $status;

    public $code;

    public $messages = array();

    public $result = array();
}
