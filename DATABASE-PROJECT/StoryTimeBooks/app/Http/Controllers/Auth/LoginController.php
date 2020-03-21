<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;



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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        // $credentials = $request->only('email', 'password');
        $credentials = [$email, $password];
        Log::info($credentials);
        
        if (Auth::attempt(['Email' => $email, 'PasswordHash' => $password])) {
            // Authentication passed...
            return view('welcome');
        } else {
            return redirect()->back()->withInput()->withErrors([ 'password' => "These credentials do not match our records." ]);

        }
    }
   
}
