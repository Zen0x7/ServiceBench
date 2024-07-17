<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\VerifyRequest;
use App\Models\User;

class VerifyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyRequest $request)
    {
        $token = $request->input("token");

        if (! User::query()->where('verification_token', $token)->exists())
            return response()->json(["message" => "unauthorized"], 401);

        if (! User::query()->where('verification_token', $token)->whereNull('email_verified_at')->exists())
            return response()->json(["message" => "forbidden"], 403);

        User::query()->where('verification_token', $token)->update([
            'email_verified_at' => now(),
        ]);

        return response()->json([
            "message" => "success",
        ]);
    }
}
