<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
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

    public function credentials(Request $request){
        return ['email'=>$request->email,'password'=>$request->password,'status'=>'active','role'=>'admin'];
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect($provider)
    {
        // dd($provider);
     return Socialite::driver($provider)->redirect();
    }

    public function vendor_login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
            return view('auth.vendor_login');
    }

    public function vendor_login_submit(Request $request)
    {
        try{
            $data= $request->all();
            $validator = \Validator::make($data, [
                'email' => 'required|string|email|exists:users',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) 
            {
                return redirect()->back()->with('error',$validator->errors()->first());
            }
            // $user = User::where('email',$request->email)->first();
        
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])
            ){
                \Session::put('user',$data['email']);
                request()->session()->flash('success','Successfully login');
                return redirect()->route('home')->with('success','Successfully login');
            }
            
            else
            {
                return redirect()->back()->with('error','Invalid Password pleas try again!');
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
 
    public function Callback($provider)
    {
        $userSocial =   Socialite::driver($provider)->stateless()->user();
        $users      =   User::where(['email' => $userSocial->getEmail()])->first();
        // dd($users);
        if($users){
            Auth::login($users);
            return redirect('/')->with('success','You are login from '.$provider);
        }else{
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);
         return redirect()->route('home');
        }
    }
}
