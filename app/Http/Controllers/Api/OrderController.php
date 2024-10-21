<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Wallet;
use Stripe;
use Illuminate\Support\Facades\Validator;


use Auth;

class OrderController extends Controller
{


    public function __construct()
    {
        $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    } 

    public function index()
    {
        try
        {
            $order = Order::with('order_detail.product')->where(['user_id'=>Auth::user()->id])->orderBy('id','desc')->get();
            return response()->json(['success'=>true,'message'=>'Orders List','data'=>$order]);
        }
        catch(\Eception $e)
        {
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
    
    public function childorders()
    {
        try
        {
            // return Auth::user()->id;
            $wallet = Wallet::where('user_id',Auth::user()->id)->first();
            $order = Order::with('shipping','order_detail.product')->where(['user_id'=>Auth::user()->id,'status'=>'parent-approval','role'=>'Child'])->get();
            // $order = Order::with('shipping','order_detail.product')->where(['user_id'=>Auth::user()->id,'role'=>Auth::user()->current_role])->get();
            return response()->json(['success'=>true,'message'=>'Order Placed Successfully','data'=>$order]);
        }
        catch(\Eception $e)
        {
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
    
    
    public function orders_status(Request $request,$id)
    {
        try
        {
            $order = Order::where('id',$id)->first();
            // return $order;
            if($request->status == 'approved')
            {
                $order->status = 'admin-approval';
                $order->save();
                $order = Order::with('shipping')->where('user_id',Auth::user()->id)->get();
                return response()->json(['success'=>true,'message'=>'Order Placed Successfully','data'=>$order]);
            }
            
            if($request->status == 'rejected')
            {
                $order->status = 'rejected';
                $order->save();
                $order = Order::with('shipping')->where('user_id',Auth::user()->id)->get();
                return response()->json(['success'=>true,'message'=>'Order Rejected Successfully','data'=>$order]);
            }
        }
        catch(\Eception $e)
        {
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }


    public function store(Request $request)
    {
        try
        {
            $validator = \Validator::make($request->all(),[
                'total_amount'=>'required',
                'address'=>'required',
                'payment_method'=>'required',
            ]);
            if($validator->fails()) {
                return response()->json(['success'=>false,'message'=>$validator->errors()],500);    
            }

            $orderid = 'ORD-'.strtoupper(\Str::random(10));
           
            if($request->payment_method == 'stripe')
            {
                $token = $request->input('stripeToken');
                    Stripe\Charge::create ([
                        "amount" => $request->total_amount * 100,
                        "currency" => "usd",
                        "source" => $request->stripeToken,
                        "description" => "This is a Dr Peter Checkout transaction" 
                    ]);
            }
            
            foreach($request->products as $product)
            {
                // $product = Product::find($productid->id);
                OrderDetail::create([
                    'order_no' => $orderid,
                    'product_id' => $product['id'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);
            }

            $order=new Order();
            $order_data=$request->all();
            $order->order_number =  $orderid;
            $order->user_id =  Auth::user()->id;
            // $order->shipping_id = $request->shipping_id;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->country = $request->country;
            $order->payment_status = ($request->payment_method == 'cod') ? 'unpaid' : 'paid' ;
            $order->post_code = $request->post_code;
            $order->phone = $request->phone;
            $order->total_amount = $request->total_amount;
            $order->address = $request->address;
            $order->status = 'new' ;
            $order->payment_method = $request->payment_method;
            // $order->role = Auth::user()->current_role;
            $order->save();
            
            return response()->json(['success'=>true,'message'=>'Order Placed Successfully','data'=>$order]);
        }
        catch(\Eception $e)
        {
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function confirm(Request $request)
    {
        $response = $this->gateway->confirm([
            'paymentIntentReference' => $request->input('payment_intent'),
            'returnUrl' => $this->completePaymentUrl,
        ])->send();
         
        if($response->isSuccessful())
        {
            $response = $this->gateway->capture([
                'amount' => $request->input('amount'),
                'currency' => env('STRIPE_CURRENCY'),
                'paymentIntentReference' => $request->input('payment_intent'),
            ])->send();
 
            $arr_payment_data = $response->getData();
 
            $this->store_payment([
                'payment_id' => $arr_payment_data['id'],
                'payer_email' => session('payer_email'),
                'amount' => $arr_payment_data['amount']/100,
                'currency' => env('STRIPE_CURRENCY'),
                'payment_status' => $arr_payment_data['status'],
            ]);
 
            return redirect("payment")->with("success", "Payment is successful. Your payment id is: ". $arr_payment_data['id']);
        }
        else
        {
            return redirect("payment")->with("error", $response->getMessage());
        }
    }
 
    public function store_payment($arr_data = [])
    {
        $isPaymentExist = Payment::where('payment_id', $arr_data['payment_id'])->first();  
  
        if(!$isPaymentExist)
        {
            $payment = new Payment;
            $payment->payment_id = $arr_data['payment_id'];
            $payment->payer_email = $arr_data['payer_email'];
            $payment->amount = $arr_data['amount'];
            $payment->currency = env('STRIPE_CURRENCY');
            $payment->payment_status = $arr_data['payment_status'];
            $payment->save();
        }
    }
}
