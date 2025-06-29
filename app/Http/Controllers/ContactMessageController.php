<?php

namespace App\Http\Controllers;

use App\Mail\IsetMail;
use App\Models\ContactMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('status', 'pending')->count();
        
        return view('admin.messages.index', compact('messages', 'totalMessages', 'unreadMessages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read if it's pending
        if ($message->status === 'pending') {
            $message->update(['status' => 'open']);
        }
        
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->delete();
            
            return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully');
        } catch (Exception $e) {
            Log::error('Failed to delete message: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete message');
        }
    }

    /**
     * Show reply form for the specified message.
     */
    public function reply(string $id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.messages.reply', compact('message'));
    }

    /**
     * Send reply to the message.
     */
    public function sendReply(Request $request, string $id)
    {
        $request->validate([
            'reply_message' => 'required|string|max:1000',
        ]);

        try {
            $message = ContactMessage::findOrFail($id);
            
            // Check if message was already answered
            if ($message->status === 'answered') {
                return redirect()->back()->with('warning', 'This message has already been answered.');
            }
            
            // Send email reply first
            $emailSent = $this->sendEmailReply($message->email, $request->reply_message, $message->message);
            
            if (!$emailSent) {
                return redirect()->back()->with('error', 'Failed to send email. Please check your email configuration.');
            }
            
            // Update message status to answered only if email was sent successfully
            $message->update([
                'status' => 'answered',
                'replied_at' => now(),
                'reply_message' => $request->reply_message
            ]);
            
            Log::info('Reply sent successfully', [
                'message_id' => $message->id,
                'user_email' => $message->email,
                'admin_user' => auth()->user()->email ?? 'Unknown'
            ]);
            
            return redirect()->route('admin.messages.index')
                ->with('success', 'Reply sent successfully to ' . $message->email);
                
        } catch (Exception $e) {
            Log::error('Failed to send reply', [
                'message_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Failed to send reply. Please try again.')
                ->withInput();
        }
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(string $id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->update(['status' => 'open']);
            
            return redirect()->back()->with('success', 'Message marked as read');
        } catch (Exception $e) {
            Log::error('Failed to mark message as read: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to mark message as read');
        }
    }

    /**
     * Send email reply to user.
     */
    private function sendEmailReply($userEmail, $replyMessage, $originalMessage)
    {
        try {
            Mail::to($userEmail)->send(new IsetMail($replyMessage, $originalMessage));
            Log::info('Email reply sent successfully', ['to' => $userEmail]);
            return true;
        } catch (Exception $e) {
            Log::error('Failed to send email reply', [
                'to' => $userEmail,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
