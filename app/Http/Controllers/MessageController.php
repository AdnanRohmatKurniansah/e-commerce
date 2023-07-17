<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function addMessage(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'message' => 'required|max:250'
        ]);

        Message::create($data);

        return redirect('/contact')->with('success', 'Your message has been sent');
    }
    public function index() {
        return view('dashboard.messages.index', [
            'messages' => Message::orderBy('id', 'desc')->get()
        ]);
    }
    public function show($id) {
        
        $message = Message::findOrFail($id);
        $message->update(['status' => 'read']);

        return view('dashboard.messages.show', [
            'message' => $message,
        ]); 
    }
    public function removeMessage(Message $message) {
        Message::destroy($message->id);
        return redirect('/dashboard/messages')->with('success', 'Message has been deleted!');
    }
}
