<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationPin;
use App\User;
use App\UserInvitation;
use App\UserPin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $credentials = [ 
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_verify' => User::USER_VERIFIED
        ];

        if(!Auth::attempt($credentials)){
            $error = "login_failed";
            return response()->json($error, 401);
        }
        $user = $request->user();
        $data['user'] = $user;
        $data['access_token'] = $user->createToken('token')->accessToken;

        return response()->json($data, 200);
    }

    public function register(UserRegisterRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->passwprd);
        $user->registered_at = Carbon::now();
        $user->save();

        UserInvitation::where('email', $user->email)->delete();
        $pin = random_int(100000, 999999);

        UserPin::create([
            'email' => $user->email,
            'pin' => $pin
        ]);

        Mail::to($user->email)->send(new SendVerificationPin($pin));

        return response()->json("User has been registered successfully. Please verify", 200);
    }
}
