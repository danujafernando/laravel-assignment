<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserVerifyRequest;
use App\Mail\SendInviation;
use App\Role;
use App\User;
use App\UserInvitation;
use App\UserPin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create(UserCreateRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'role_id' => Role::ROLE_USER
        ]);

        $token = Str::random(32);
        
        UserInvitation::create([
            'email' => $request->email,
            'token' => $token
        ]); 

        $invitationUrl = route('home', ['token=' . $token]);
        Mail::to($user->email)->send(new SendInviation($invitationUrl));

        return response()->json("User has been created successfully.", 201);
    }

    public function verify(UserVerifyRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->is_verify = 1;
        $user->save();

        UserPin::where('email', $user->email)->delete();

        return response()->json("User has been verified successfully.", 200);
    }

    public function profile(Request $request)
    {
        $data['user']  = $request->user();

        return response()->json($data, 200);
    }

    public function updateProfile(UserUpdateRequest $request)
    {
        $avatarPath = null;
        $user = $request->user();
        $user->user_name = $request->user_name;
        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->avatar->store('avatars');
        }
        $user->avatar = $avatarPath;
        $user->save();

        return response()->json("User has been updated successfully.", 200);
    }
}
