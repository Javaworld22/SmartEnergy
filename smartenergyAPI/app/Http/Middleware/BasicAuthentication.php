<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use illuminate\Http\Request;

class BasicAuthentication
{
    /*
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */

    use AuthenticatesUsers;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!is_null($request->header('Authorization'))) {
            // Log::info(getallheaders());
            $login_req = base64_decode(str_replace('Basic ', '', $request->header('Authorization')));
            // Log::info(base64_decode(str_replace("Basic ","",getallheaders()['Authorization'])));
            // Log::info($login_req);
            try {
                $username = explode(':', $login_req)[0];
                $password = explode(':', $login_req)[1];
                $login = new Request();
                $login->setMethod('POST');
                $login->request->add([
                                'username' => $username,
                                'password' => $password,
                            ]);

                // $this->validateLogin($login);
                // die("Error");
                if (Auth::attempt([
                                'username' => $username,
                                'password' => $password,
                            ])) {
                    return $next($request);
                } else {
                    return response()->json([
                                'Error' => 'Authentication Failed',
                            ], '401');
                }
            } catch (\Exception $e) {
                return response()->json([
                                'Error' => 'Authentication Failed',
                            ], '401');
            }
        } else {
            return response()->json([
            'Error' => 'Authentication Failed',
        ], '401');
        }
    }
}
