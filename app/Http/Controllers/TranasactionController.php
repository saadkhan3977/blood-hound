<?php

namespace App\Http\Controllers;

use App\Models\Tranasaction;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Notification;
use App\Notifications\StatusNotification;

class TranasactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
          $stripe = \Stripe\Stripe::setApiKey('sk_test_51LCrVHHNvw3AIrpxjbOuGKoRaQ3K68ZDXrgU41PRmyDb9eH7h9qShHEn1T8gEUV7amg1TfNSy1cVXWaREFgcfmMr00yqKik6dg');
    }

    public function index()
    {
        try 
        {     
            $data = Tranasaction::where('user_id',Auth::user()->id)->paginate(10);
            
            return response()->json(['success'=>true,'date'=> $data]);
            
        } catch (\Stripe\Error\Card $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    public function transaction_list()
    {
        try 
        {     
            $data['transaction'] = Tranasaction::get();
            
            return view('admin.transaction',$data);
            
        } 
        catch (\Stripe\Error\Card $e) 
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    public function transaction_status($id)
    {
        try 
        {     
            $tranasaction = Tranasaction::find($id);
            $wallet = Wallet::where('user_id',$tranasaction->user_id)->first();
            $pending =  $wallet->pending_amount - $tranasaction->amount; 
            $withdraw = $wallet->withdraw + $tranasaction->amount; 
            $amount = $wallet->amount - $tranasaction->amount;
            // echo $pending;
            // echo "<pre>";
            // echo $withdraw;
            // die;
            $tranasaction->status = request('status');
            $tranasaction->save();
            
            $wallet->pending_amount = $pending;
            $wallet->amount = $amount;
            $wallet->withdraw = $withdraw;
            $wallet->save();

            $users = User::find($tranasaction->user_id);
            $details=[
                'title'=>'Admin',
                'description'=>'Transaction Approved',
            ];
            \Notification::send($users, new StatusNotification($details));

            return redirect()->back()->with(['success'=>'Transaction Approved Successfull']);
            
        } 
        catch (\Stripe\Error\Card $e) 
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $valiadator = Validator::make($request->all(),[
                'amount' =>'required',
                'date' =>'required',
                'reason' => 'required',
                'type' => 'required',
            ]);
            if($valiadator->fails())
            {
                return response()->json(['success'=>false,'message' => $valiadator->errors()]);
            }        
            $data = Tranasaction::create([
                'user_id' => Auth::user()->id,
                'amount' => $request->amount,
                'date' => $request->date,
                'reason' => $request->reason,
                'type' => $request->type,
                'status' => 'Pending',
            ]);
            
            $wallet = Wallet::where('user_id',Auth::user()->id)->first();
            $pending = (int)$wallet->pending_amount + (int)$request->amount;
            $wallet->pending_amount = $pending;
            $wallet->save();

            $user = User::with(['goal','temporary_wallet','wallet','payments'])->where('id',Auth::user()->id)->first();
            return response()->json(['success'=>true,'message' => 'Tranasaction SuccessFully','date'=> $data,'user_info'=>$user]);
            
        } catch (\Stripe\Error\Card $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tranasaction  $tranasaction
     * @return \Illuminate\Http\Response
     */
    public function show(Tranasaction $tranasaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tranasaction  $tranasaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Tranasaction $tranasaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tranasaction  $tranasaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tranasaction $tranasaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tranasaction  $tranasaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tranasaction $tranasaction)
    {
        //
    }
}
