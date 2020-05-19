<?php
namespace App\Http\Controllers\Users;
use App\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;


class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();
        if ($request->role !== null) {
            $user->role = $request->role;
            $user->is_Deleted = $request->is_Deleted;
        }
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }
    /**
     * Login user and return a token
     */
    public function login(Request $request)
    {
        $userStatus = DB::table('users')->where('email', $request->email)->value('is_deleted');
        $credentials = $request->only('email', 'password');
        
        if ($userStatus == 0) {
            if ($token = $this->guard()->attempt($credentials)) {
                return response()->json(['status' => 'success', 'creds' => $credentials, 'token' => $token], 200)->header('Authorization', $token);
            } else 
            return response()->json(['error' => 'login_error'], 401);
        } else
        return response()->json(['error' => 'This user has been deleted'], 401);
    }
    /**
     * Logout User
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    /**
     * Checks if given email address exists in an account.
     */
    public function checkIfEmailExists(Request $request) {
        $email = DB::table('users')->where('email', '=', $request->email)->get()->pluck('email');
        $exists = false;
        
        if (!$email->isEmpty()) {
            $exists = true;
            return response()->json([
                'status' => 'success',
                'email_exists' => $exists,
                'correct_email' => $email,
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'email_exists' => $exists,
                'email' => null
            ], 200);
    }
    }
    /**
     * Get authenticated user
     */
    public function user(Request $id)
    {
        // how to get data...Auth::user()->whatever parameter in the user record
        $user = Auth::user();
         return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}