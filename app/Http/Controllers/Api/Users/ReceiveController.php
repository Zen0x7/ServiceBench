<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $messages = Message::query()
            ->where("on", MessageService::toString(auth()->user()->id, $user->id))
            ->where(function($query) use ($user) {
                $query->where([
                    'from_id' => auth()->user()->id,
                    'to_id' => $user->id,
                ])->orWhere([
                    'from_id' => $user->id,
                    'to_id' => auth()->user()->id,
                ]);
            })
            ->with(['from', 'to'])
            ->paginate();

        return response()->json($messages);
    }
}
