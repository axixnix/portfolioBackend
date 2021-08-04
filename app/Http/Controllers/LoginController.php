<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $user = User::where('email', $request->input('identifier'))
            ->orWhere('name', $request->input('identifier'))
            ->first();

        if (is_null($user)) return response(['message' => 'credentials do not match our records'], 401);
        if (Hash::check($request->input('password'), $user->password)) {
            $token = Crypt::encryptString($user->id);
            return response(['message' => 'logged in successfuly'])->withCookie('authentication', $token, time() + (86400 * 30), '/');
        } else {
            return response(['message' => 'the credentials do not match our records'], 401);
        }
    }

    public function loggout()
    {
        Auth::logout();
        return response(['message' => 'user logged out successfuly'], 200);
    }
}
