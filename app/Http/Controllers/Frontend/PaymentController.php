<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaymentController extends Controller
{
    //
    public function index($id){

        $payment=Payment::findOrFail($id);
        return view('front.payment.index',compact('payment'));

    }
    public function payment($id){
        $payment=Payment::findOrFail($id);
        $data=[];
        $data['items']=[
            [
                'name'=>"$payment->name",
                'price'=>200,
                'desc'=>'Description',
                'qty'=>1,
            ],
        ];
        $return_url=route('successPayment',$payment->id);
        $cancel_url=route('cancelPayment',$payment->id);
        $data['invoice_id']=1;
        $data['invoice_description']="Service ##{{$payment->service_id}} Invoice ";
        $data['return_url']="$return_url";
        $data['cancel_url']="$cancel_url";
        $data['total']=$payment->price;




     return   $provider=new ExpressCheckout;
        $response=$provider->setExpressCheckout($data,true);

        dd($response);

        return redirect($response['paypal_link']);

    }

    public function cancel(Request $request,$id){
         dd($request);
    }
    public function success(Request $request,$id){
        $provider=new ExpressCheckout;
        $response=$provider->getExpressCheckoutDetails($request->token);

        dd($request);
    }
}
