<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RevokeRequest;

class RevokeController extends Controller
{
    public function __invoke(RevokeRequest $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}
