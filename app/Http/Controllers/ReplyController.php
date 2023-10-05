<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id',
        ]);
    
        $reply = new Reply([
            'content' => $request->input('content'),
        ]);
    
        $reply->user_id = auth()->user()->id; // Assign the currently logged-in user to the reply
        $reply->ticket_id = $request->input('ticket_id');
    
        $reply->save();
    
        return redirect()->back()->with('success', 'Reply added successfully');
    } //
}
