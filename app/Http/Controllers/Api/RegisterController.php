<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Goal;
use App\Models\Child;
use App\Models\Review;
use App\Models\TemporaryWallet;
use App\Models\Tranasaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Mail\SendVerifyCode;
use Mail;
use Carbon\Carbon;
use Twilio\Rest\Client; 
use Hash;
use Image;
use File;
use Stripe\Customer;


class RegisterController extends BaseController
{
    public function userinfo($email)
    {
        return User::where('email', $email)->first();
    }
    

    public function register(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',			
            'phone' => 'required',			
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
			'photo' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
        ]);      
        if($validator->fails())
        {
		    return $this->sendError($validator->errors()->first());
        }
        
		$fileName = null;
        $input = $request->except(['confirm_password'],$request->all());
        if($request->hasFile('photo')) 
        {
            $file = request()->file('photo');
            $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/user/profiles/', $fileName);  
            $profile = asset('uploads/user/profiles/'.$fileName);
            $input['photo'] = '/uploads/user/profiles/'.$fileName;//$profile;
        }

        $input['password'] = bcrypt($input['password']);
        
		$input['email_verified_at'] = Carbon::now();
        $user = User::create($input);

        $token =  $user->createToken('blood-hound')->plainTextToken;
        $users = $this->userinfo($request->email);

		return response()->json(['success'=>true,'message'=>'User register successfully' ,'token'=>$token,'user_info'=>$users]);
    }

    public function login(Request $request)
    {   
        if(!empty($request->email) || !empty($request->password))
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
                'password' => 'required',        
            ]);  
            if($validator->fails())
            {
				return $this->sendError($validator->errors()->first());
            }

            $user = User::firstWhere('email',$request->email);
            
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            { 
                $user = Auth::user();
                $token =  $user->createToken('app_api')->plainTextToken; 
                $users = $this->userinfo($request->email);
                return response()->json(['success'=>true,'message'=>'User Logged In successfully' ,'token'=>$token,'user_info'=>$users]);
            } 
            else
            { 
                return $this->sendError('Incorrect Password');
            } 
        }
        else
        {
		    return $this->sendError('Email & Password are Required');
        }
    }

    public function me()
    {
        $user = User::with(['child','goal','temporary_wallet','wallet','payments'])->where('id',Auth::user()->id)->first(); 
        return response()->json(['success'=>true,'message'=>'User Fetch successfully','user_info'=>$user]);
    }
    public function logout()
    {
        if(Auth::check())
        {
            $user = Auth::user()->token();
            $user->revoke();
            $success['success'] =true; 
            return $this->sendResponse($success, 'User Logout successfully.');
        }
        else
        {
            return $this->sendError('No user in Session .');
        }
    }
    public function user(Request $request)
    {
        
        $success['tag_list'] = User::where('role','user')->get();
        return $this->sendResponse($success, 'Tags Lists');
    }
    public function verify(Request $request)
    {
		$validator = Validator::make($request->all(),['email_code'=>'required']);
        if($validator->fails())
        {
            return $this->sendError($validator->errors()->first());       
        }

        $user = User::firstWhere('email_code',$request->email_code);
        if($user == null)
        {
            return $this->sendError('Token Expire or Invalid');
        }
        else
        {
            $user->update(['email_verified_at'=>Carbon::now(),'email_code'=>null]);
            $success['success'] =true; 
            return $this->sendResponse($success, 'Email verified Successfully');
        }
    }
    public function change_password(Request $request)
    {
        try
        {
                                          
            $validator = Validator::make($request->all(),[
                'current_password' => 'required',
                'new_password' => 'required|same:confirm_password|min:8',
                'confirm_password' => 'required',
            ]);

            if($validator->fails())
            {
                return $this->sendError($validator->errors()->first());       
            }
            $user = Auth::user();

            if (!Hash::check($request->current_password,$user->password)) 
            {
                return $this->sendError('Current Password Not Matched');
            }
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['success'=>true,'message'=>'Password Successfully Changed','user_info'=>$user]);
        }
        catch(\Eception $e)
        {
            return $this->sendError($e->getMessage());    
        }
    }   

    public function noauth()
    {
	    return $this->sendError('session destroyed , Login to continue!');
	}
	

}
