<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe;
use App\Models\Donate;
use Auth;

class DonateController extends Controller
{
    public function __construct()
    {
        $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }


    public function store(Request $request)
    {
        try
        {
            $validator = \Validator::make($request->all(),[
                'category'=>'required',
                'sub_category'=>'required',
                'donation_amount'=>'required',
            ]);
            if($validator->fails()) {
                return response()->json(['success'=>false,'message'=>$validator->errors()],500);    
            }

            
            $token = $request->input('stripeToken');
            Stripe\Charge::create ([
                "amount" => $request->donation_amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This is a Dr Peter Donation transaction" 
            ]);
            
            $order=new Donate();
            $order_data=$request->all();
            $order->user_id =  Auth::user()->id;
            $order->donation_amount = $request->donation_amount;
            $order->category = $request->category;
            $order->sub_category = $request->sub_category;
            $order->save();
            
            return response()->json(['success'=>true,'message'=>'Donated Successfully','data'=>$order]);
        }
        catch(\Eception $e)
        {
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
}
