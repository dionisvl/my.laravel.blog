<?php

declare(strict_types=1);

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

    public function testView()
    {
        return view('chat::chat.pages.test');
    }
}
