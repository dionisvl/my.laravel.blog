<?php

namespace Dionisvl\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ChatController extends Controller
{
    public function checkStatus()
    {

    }

    public function start(): void
    {
        Artisan::call('chat:start');
        dd(Artisan::output());
    }

    public function stop()
    {

    }
}
