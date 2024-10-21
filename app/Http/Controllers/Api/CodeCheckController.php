<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;

use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Models\User;
use Validator;
use Hash;
class CodeCheckController extends BaseController
{
	
	
	
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(),[
			'email' => 'required|exists:users',
            'password' => 'required|string|min:8',
			'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) 
        {    
		return response()->json(['message'=>$validator->errors()->first()]);
        } 

		$user =User::firstWhere('email',$request->email);

        if($user != null){
		 $user->update([
			 'password'=>Hash::make($request['password']),
			'email_code'=> null
		 ]);

		return response()->json(['user'=>$user,'message'=>'successfully password reset']);

        }
        else
        {
		return response()->json(['message'=>'User does not exitsts']);

        }
        
    }
	
	public function code_verify(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'code' => 'required|min:4'
        ]);
	 	if ($validator->fails()) 
        {    
		return response()->json(['message'=>$validator->errors()->first()]);
        } 
		
		$user =User::firstWhere(['email_code'=>$request->code]);
			
		if($user != null)
		{
			
			return response()->json(['message'=>'Code or Email Verified']);


		}else{
		return response()->json(['message'=>'Code is Invalid']);


		}
	}
	
}
