<?php

namespace App\Http\Controllers;

use App\Utils\RandomFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\Verification;

class RegisterController extends Controller
{
    //
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response(['message' => $validator->errors()], 422);
        }


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))

        ]);

        $verification = new Verification;
        $verification->payload = RandomFunctions::generateRandomString(5);
        $check = true;
        do{
            $check = !is_null(Verification::where('payload', $verification->payload)->first());
        } while($check);
        $user->verifications()->save($verification);

        Mail::to($user->email)->send(new VerifyEmail($user, $verification));

        return response(['message' => 'user created successfully'], 200);
    }
}
