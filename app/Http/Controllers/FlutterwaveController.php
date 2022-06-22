<?php

namespace App\Http\Controllers;

use App\Enums\CartType;
use App\Services\CartService;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    private $cart;

    function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize()
    {
        return request()->all();
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => request()->amount,
            'email' => request()->email,
            'tx_ref' => $reference,
            'currency' => "USD",
            'redirect_url' => route('flutter.callback'),
            'customer' => [
                'email' => request()->email,
                "phone_number" => request()->phone,
                "name" => request()->name
            ],

            "customizations" => [
                "title" => config('app.name'),
                "description" => now()->format('d-m-Y H:i:s')
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {

        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            // // if payment is for order then redirect to order payment success method
            // if ($this->cart->getCartType() == CartType::NewOrder) {

            // }else{
            //     // if payment is for wallet then redirect to wallet payment success method
            //     return redirect()->route('handle_succesfull_online_payment'); 
            // }
            return redirect()->route('handle_succesfull_online_payment');
        } elseif ($status ==  'cancelled') {
            //Put desired action/code after transaction has been cancelled here
            return redirect()->route('choose_payment_method')
                ->withError('Your payment has been cancelled.');
        } else {
            return redirect()->route('choose_payment_method')
                ->withError('Your payment has been failed. Please try again!');
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}
