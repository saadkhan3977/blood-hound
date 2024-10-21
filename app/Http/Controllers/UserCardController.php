<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use App\Models\UserCardDetail;
class UserCardController extends Controller
{
    
    public function __construct()
    {
          $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }
	
	
	public function updatecard(Request $request)
    {
        try{
			$input = $request->all();
            
			//$stripe->customers->retrieve(
			//	Auth::user()->stripe_id,
			//	[]
			//);
			\DB::table('customer_history')->insert([
				'user_id'=> Auth::user()->id,
				'stripe_id'=> Auth::user()->stripe_id,
				'pm_last_four'=> Auth::user()->pm_last_four,
				'pm_type'=> Auth::user()->pm_type,
				'exp_month'=> Auth::user()->exp_month,
				'exp_year'=> Auth::user()->exp_year,
			]);
			 $customer = \Stripe\Customer::create([
                'source' => $input["token"]["id"],
                'email' => Auth::user()->email,
            ]);
            
            $user = User::find(Auth::user()->id);
			$user->stripe_id = $customer["id"];
            $user->pm_last_four = $input["token"]["card"]["last4"] ?? "";
            $user->pm_type = $input["token"]["card"]["brand"] ?? "";
			$user->exp_month = $input["token"]["card"]["expMonth"] ?? "";
			$user->exp_year = $input["token"]["card"]["expYear"] ?? "";
            $user->card_change_limit - 1;
			$user->save();		
			$users = User::with(['goal','temporary_wallet','wallet','payments'])->where('id',Auth::user()->id)->first();
			return response()->json(['success'=>true,'message'=>'Card Update Successfully','data'=>$users]);
		    //return response()->json($user, 200);
        }
        catch(\Exception $e){
          return response()->json(["success" => false, 'error'=>$e->getMessage()],500);
        }
    }
	
    public function addcard(Request $request)
    {
        try{
            $input = $request->all();
		    $customer = \Stripe\Customer::create([
                'source' => $input["token"]["id"],
                'email' => Auth::user()->email,
            ]);
            $user = User::find(Auth::user()->id);
            $user->stripe_id = $customer["id"];
            $user->pm_last_four = $input["token"]["card"]["last4"] ?? "";
            $user->pm_type = $input["token"]["card"]["brand"] ?? "";
			$user->exp_month = $input["token"]["card"]["expMonth"] ?? "";
			$user->exp_year = $input["token"]["card"]["expYear"] ?? "";
            $user->save();
			$users = User::with(['goal','temporary_wallet','wallet','payments'])->where('id',Auth::user()->id)->first();
			return response()->json(['success'=>true,'message'=>'Card Add Successfully','data'=>$users]);
        }
        catch(\Exception $e){
          return response()->json(["success" => false, 'error'=>$e->getMessage()],500);
        }


        
        // $response =  \Stripe\Token::create([
        //     'card' => [
        //       'number' => '4242424242424242',
        //       'exp_month' => 1,
        //       'exp_year' => 2024,
        //       'cvc' => '314',
        //     ],
        //   ]);

        
   

        //  $charge = \Stripe\Charge::create([
        //     'amount' => 1000*100,
        //     'currency' => 'usd',
        //     'customer' => "cus_NC4RFLkNbm5KAA",
        // ]);
        
        // Payment::create([

        // ]);

        // return response()->json($charge, 200);
        // $valid = Validator::make($request->all(),[
        //     'card_name'=>'required|string',
        //     'card_number'=>'required|numeric|digits:16',
        //     'exp_month'=>'required|numeric|digits:2',
        //     'exp_year'=>'required|numeric|digits:2',
        //     'cvv'=>'required|numeric|digits:3',
        // ]);
        // if( $valid->fails())
        // {
        //     return response()->json(['success'=>true , 'error'=> $valid->errors()]);
        // }
        //  $user =User::with(['user_card'])->find(Auth::id());
        // if($user->user_card == null){
        //   $user->user_card()->create([
        //         'card_name' => $request->card_name,
        //         'card_number' =>$request->card_number,
        //         'exp_month' =>$request->exp_month,
        //         'exp_year' =>$request->exp_year,
        //         'cvv' =>$request->cvv                
        //     ]);
        //     $response['user_info'] = User::with(['user_card'])->find(Auth::id());
        //     return response()->json(['success'=>true , 'response'=> $response]);
        // }else{
        //     $response['user_info'] =User::with(['user_card'])->find(Auth::id());
        //     $response['error'] = 'Your card is already Uploaded';
        //     return response()->json(['success'=>true , 'response'=> $response]);
        // } 
        
        
        
    }
}
