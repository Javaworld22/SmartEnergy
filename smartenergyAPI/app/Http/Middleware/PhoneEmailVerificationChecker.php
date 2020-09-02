<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PhoneEmailVerificationChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if(Auth::user()->apiRole->name == 'user'){

            if($user->phone_email_verified_at == ""){ //Not verified account

                return response()->json(["status"=>"error","message"=>"Account not verified."],401);

            }
        }

        return $next($request);   
    }
    
}
