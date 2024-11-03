<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubsController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|unique:subscriptions',
                'countMe' => 'required|numeric|min:3',
            ]
        );

        $honeypot = $request->get('honeypot');
        if (!empty($honeypot)) {
            return redirect()->back()->withErrors(['Error: HPF']);
        }

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->with('dangerStatus', implode(', ', $validator->errors()->all()));
        }

        // Получение значения reCAPTCHA из POST-запроса
        $captchaResponse = $request->get('recaptcha_response');
        // Проверка reCAPTCHA
        $secretKey = env('GOOGLE_RECAPTCHA_V3_SECRET_SERVER');
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}"
        );
        $responseData = json_decode($response, false);

        if ($responseData->success) {
            // Ваш код для обработки формы, если reCAPTCHA прошла успешно
            return $this->subscribe($request);
        }
        // Обработка ошибки, если reCAPTCHA не пройдена
        return redirect('/')->with('status', 'reCAPTCHA не пройдена' . json_encode($response));
    }

    private function subscribe(Request $request)
    {
        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();

        Mail::to($request->get('email'))->send((new SubscribeEmail($subs->token)));

        if (count(Mail::failures()) > 0) {
            return redirect('/')->with(
                'dangerStatus',
                'Ошибка при отправке письма: ' . implode(', ', Mail::failures())
            );
        }

        return redirect('/')->with('status', 'Проверьте вашу почту!');
    }

    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();
        return redirect('/')->with('status', 'Ваша почта подтверждена! спасибо!');
    }
}
