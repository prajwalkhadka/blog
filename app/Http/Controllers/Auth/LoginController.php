<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite; 
use App\user;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

       public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        //dd($user);
         $finduser=User::where('email',$user->getEmail())->first();
         if($finduser){
            Auth::login($finduser);
         }
         else{
            if($user->getName()){
                $username= $user->getName();
            }
            else{
                $username= $user->getNickname();
            }
            $newuser=User::create([

            'name' =>$username,
            'email' =>$user->getEmail(),
            'image' =>$user->getAvatar(),
            'provider'=>$provider,
            'password'=>Hash::make(str_random($length=16)),
            "email_verified_at"=>Carbon::now(),

            ]);
            Auth::login($newuser);
         }
         return redirect()->route('home');
}
    }
   
