<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class PortfolioAuth
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
        if ($request->hasCookie('Authentication')) {
            try {
                $cookie = $request->cookie('Authentication');
                $value = Crypt::decryptString($cookie);
                $user = User::find($value);
                echo $value;
                if ($value && $user) {
                    $request->attributes->add(['user' => $user]);
                    Auth::onceUsingId($value);
                    return $next($request);
                } else
                    return response(["message" => "Unauthenticathhhhed"], 401);
            } catch (DecryptException $exp) {
                echo $exp->getMessage();
                return response(["message" => "Unauthenticateyd"], 401);
            }
        }
        return response(["message" => "asdfghdfgUnauthenticated"], 401);
    }
}