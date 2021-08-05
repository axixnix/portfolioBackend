<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
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
        if ($request->hasHeader('Authentication')) {
            try {
                $header = $request->header('Authentication');
                $value = Crypt::decryptString($header);
                $user = User::find($value);
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
