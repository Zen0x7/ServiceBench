<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::query()
            ->select(['id', 'name', 'email'])
            ->get();

        return response()->json($users);
    }
}
