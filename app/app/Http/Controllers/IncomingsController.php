<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IncomingsController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'message' => 'required'
        ]);

        $incoming = new Incoming();
        $incoming->name = $request->get('name');
        $incoming->email = $request->get('email');
        $incoming->phone = $request->get('phone');
        $incoming->message = $request->get('message');
        $incoming->save();

        return response()->json(
            [
                'status' => 'ok',
                'timestamp' => time(),
                'data' => 'Your message was received! thankyou!'
            ]
        );
    }
}
