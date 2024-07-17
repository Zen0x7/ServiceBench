<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyRequest $request, string $token)
    {
        if (! User::query()->where('verification_token', $token)->exists())
            abort(404);

        User::query()->where('verification_token', $token)->update([
            'email_verified_at' => now(),
        ]);

        return view('auth.verification-success');
    }
}
