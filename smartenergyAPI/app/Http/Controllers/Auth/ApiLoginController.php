<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Utils\BusinessUtil;
use Illuminate\Support\Facades\Log;

class ApiLoginController extends Controller
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
     * All Utils instance.
     */
    protected $businessUtil;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Change authentication from email to username.
     */
    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        request()->session()->flush();
        \Auth::logout();

        return response()->json([
            'data' => 'Logout Successfull',
        ]); 
    }


    public function basicauth(Request $request)
{
    if (!is_null($request->header('Authorization')))
{
    // Log::info(getallheaders());
     $login_req = base64_decode(str_replace("Basic ","",$request->header('Authorization')));
     // Log::info(base64_decode(str_replace("Basic ","",getallheaders()['Authorization'])));
     Log::info($login_req);
     $username = explode(':', $login_req)[0];
     $password = explode(':', $login_req)[1];
     $login = new Request();
     $login->setMethod('POST');
     $login->request->add([
            'username' => $username,
            'password' => $password
        ]);
        $this->validateLogin($login);
            if ($this->attemptLogin($login)) {
        $user = $this->guard()->user();
        // $user->generateToken();

        return response()->json([
            'data' => $user->toArray(),
        ]);
    }
       return response()->json([
            'data' => 'Error Login',
        ]); 

    
}   


    // return $this->sendFailedLoginResponse($request);
}

    public function loginapi(Request $request)
{
    $this->validateLogin($request);

    if ($this->attemptLogin($request)) {
        $user = $this->guard()->user();
        // $user->generateToken();

        return response()->json([
            'data' => $user->toArray(),
        ]);
    }
       return response()->json([
            'data' => 'Error Login',
        ]); 
    // return $this->sendFailedLoginResponse($request);
}
    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'data' => $user->toArray(),
        ]);
    }


}
