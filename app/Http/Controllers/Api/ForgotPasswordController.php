<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use Mail;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;
use App\Models\User;
class ForgotPasswordController extends BaseController
{
    public function forget(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'email' => 'required|email|exists:users',
        ]);
        if ($validator->fails()) 
        {    
			return $this->sendError($validator->errors()->first());
        } 
		
		$user = User::firstWhere('email',$request->email);
		if($user != null)
		{
			$data['code'] = mt_rand(9000, 9999);
			$data['email'] = $request->email;
			$user->update(['email_code'=>$data['code'] ]);
		    Mail::to($user->email)->send(new SendCodeResetPassword($user->email_code));	
			// return $data;
			$success = [$data];
	        return $this->sendResponse($success, trans('passwords.sent'));
		}else{
		 return $this->sendError('User does not exitsts');

		}


    }
}
