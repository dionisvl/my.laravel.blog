<?php

declare(strict_types=1);

namespace Dionisvl\Chat\resources\views\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class ChatBox extends Component
{
    /**
     * Create the component instance.
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('chat::chat.chatbox');
    }
}
