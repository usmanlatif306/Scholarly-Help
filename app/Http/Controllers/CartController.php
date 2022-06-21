<?php

namespace App\Http\Controllers;

use App\Order;
use App\Enums\CartType;
use App\Services\CartService;
use App\Services\CalculatorService;
use Mews\Purifier\Facades\Purifier;
use App\Http\Requests\StoreOrderRequest;

class CartController extends Controller
{
    public function storeOrderInSession(StoreOrderRequest $request, CalculatorService $calculator, CartService $cart)
    {
        $extra = $request->all();
        $data = $request->validated();
        $data['sub_category'] = $extra['sub_category'] ? $extra['sub_category']['id'] : null;
        $data = array_merge($data, $calculator->calculatePrice($data));
        $data['customer_id'] = auth()->user() ? auth()->user()->id : null;
        $data['cart_total'] = $data['total'];
        $data['staff_payment_amount'] = $calculator->staffPaymentAmount($data['cart_total']);
        $data['title'] = Purifier::clean($request->input('title'));
        $data['instruction'] = Purifier::clean($request->input('instruction'));
        $data['guarantee'] = $extra['guarantee_model']['name'];
        $data['sub_category'] = $extra['sub_category'] ? $extra['sub_category']['name'] : null;
        $data['subject'] = $extra['subject']['name'];
        $data['time'] = $extra['time'];

        $orderService = app()->make('App\Services\OrderService');
        $order = $orderService->create($data);

        $cart->setCart([
            'order_id' => $order->id,
            'order_number' => $order->number,
            'cart_total' => $data['cart_total']
        ], CartType::NewOrder);

        session()->flash('success', 'Order has been saved. Please make the payment to confirm it');
        session(['orderId' => $order->id]);
        return response()->json([
            'status' => 'success',
            'redirect_url' => route('choose_writer', $order->id)
        ]);
    }

    public function makePaymentForExistingOrder(Order $order, CartService $cart)
    {
        if ($order->customer_id = auth()->user()->id) {

            $cart->setCart([
                'order_id' => $order->id,
                'order_number' => $order->number,
                'cart_total' => $order->total
            ], CartType::NewOrder);

            return redirect()->route('choose_payment_method');
        }
    }
}
