<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    //
    public function index($id){

        $payment=Payment::findOrFail($id);
        return view('front.Payment.index',compact('payment'));

    }
    public function payment($id){
        $payment=Payment::findOrFail($id);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken=$provider->getAccessToken();

        $response = $provider->createOrder([
            "intent"=> "CAPTURE",
            "application_context"=> [
                "return_url"=> route('successPayment',$payment->id),
                "cancel_url"=> route('cancelPayment',$payment->id),
            ],

            "purchase_units"=>[
                [
                    "amount"=>[
                        "currency_code"=> "USD",
                        "value"=> $payment->price,
                    ]

            ]
            ]

        ]);
//        dd($response);

        if (isset($response['id']) && $response['id']!=null){
            foreach ($response['links'] as $link){
                if ($link['rel']==='approve'){
                    return redirect()->away($link['href']);
                }
            }
            return  redirect()->route('cancelPayment',$payment->id);

        }
        else{
            return  redirect()->route('cancelPayment',$payment->id);
        }

    }

    public function cancel(Request $request,$id){
         dd($request);
    }
    public function success(Request $request,$id){

        $payment=Payment::findOrFail($id);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken=$provider->getAccessToken();
        $response =$provider->capturePaymentOrder($request->token);


        if (isset($response['status'])  && $response['status']=='COMPLETED'){
             $payment->update([
                 'status'=>'paid',
                 'paid_date'=>date('Y-m-d'),
             ]);
        }
        else
            $payment->update([
                'status'=>'cancel',

            ]);



        dd($response);

    }
}
