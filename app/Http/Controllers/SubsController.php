<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Mail\SubscribeEmail;
use Illuminate\Http\Request;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
//        $subs = Subscription::add('123@123.ru');
//        $subs->generateToken();
//        return (new SubscribeEmail($subs))->build();
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->with('dangerStatus', implode(', ', $validator->errors()->all()));
        }

        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();

        \Mail::to($request->get('email'))->send((new SubscribeEmail($subs->token)));

        if (count(\Mail::failures()) > 0) {
            return redirect('/')->with('dangerStatus', 'Ошибка при отправке письма: ' . implode(', ', \Mail::failures));
        } else {
            return redirect('/')->with('status', 'Проверьте вашу почту!');
        }

    }

    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();
        return redirect('/')->with('status', 'Ваша почта подтверждена! спасибо!');
    }
}
