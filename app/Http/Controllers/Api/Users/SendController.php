<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageReceived;
use App\Notifications\MessageSent;
use App\Services\MessageService;
use Illuminate\Http\Request;

class SendController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $message = Message::query()
            ->create([
                'on' => MessageService::toString(auth()->user()->id, $user->id),
                'from_id' => auth()->user()->id,
                'to_id' => $user->id,
                'body' => $request->input('body'),
            ]);

        $message->load(['from', 'to']);

        $user->notify(new MessageReceived($message));
        auth()->user()->notify(new MessageSent($message));

        return response()->json();
    }
}
