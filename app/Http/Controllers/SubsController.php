<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Mail\SubscribeEmail;
use Illuminate\Http\Request;

class SubsController extends Controller
{
    public function subsribe(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:subscriptions'
        ]);

        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();

        \Mail::to($request->user())->send(new SubscribeEmail($subs));

        return redirect()->back()->with('status', 'Проверьте вашу почту!');
    }

    public function verify($token){
        $subs = Subscription::where('token',$token)->firstOrFail();
        $subs->token = null;
        $subs->save();
        return redirect('/')->with('status', 'Ваша почта подтверждена! спасибо!');
    }
}
