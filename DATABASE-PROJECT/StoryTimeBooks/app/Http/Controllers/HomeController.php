<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Splits up the Closure problem in api.php. It was a Laravel bug I researched that wouldn't
     * compile when the php artisan route:cache command is ran.
     */
    public function AuthRouteAPI(Request $request){
        return $request->user();
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
