<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function admin(Request $request)
    {
        return 'asd';
        try{
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
            'password'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with(['error'=>$validator->errors()->first()]);

        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'role'=>'admin'])) {
            return redirect()->route('dashboard');       
        }else{
            return back()->with(['error'=>'Invalid Credentials']);
        }
    }catch(\Exception $e){
        return redirect()->back()->with(['error'=>$e->getMessage()]);
    }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
