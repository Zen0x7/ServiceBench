<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'verification_token' => Str::random(64),
        ]);

        Mail::to($user)->send(new UserRegistered($user));

        return response()->json([
            "message" => "success"
        ]);
    }
}
