<?php

declare(strict_types=1);

namespace Dionisvl\Shop\Http\Controllers;

use App\Http\Controllers\API\ResponseObject;
use App\Http\Controllers\Controller;
use Dionisvl\Shop\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadeResponse;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $response = new ResponseObject();

        $data = json_decode($request->json()->all()[0], true);
        $validator = Validator::make($data, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            $response->status = $response::status_fail;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                $response->messages[] = $item;
            }
        } else {
            $order = Order::add($data);

            $response->status = $response::status_ok;
            $response->code = $response::code_ok;
            $response->result = [
                'message' => 'Ваш заказ был принят! Спасибо!',
                'order_id' => $order->id,
            ];
        }

        return FacadeResponse::json($response);
    }
}
