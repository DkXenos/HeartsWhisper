<?php

namespace App\Http\Controllers;

use App\Models\ModeratorRequest;
use Illuminate\Http\Request;

class ModeratorRequestController extends Controller
{
    // Show the form to submit a moderator request
    public function create()
    {
        $user = auth()->user();
        
        // Check if user is already a moderator or admin
        if ($user->role !== 'user') {
            return redirect()->route('dashboard')->with('error', 'You are already a moderator or admin.');
        }
        
        // Check if user already has a pending request
        $existingRequest = ModeratorRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();
            
        if ($existingRequest) {
            return redirect()->route('dashboard')->with('info', 'You already have a pending moderator request.');
        }
        
        return view('moderator.request');
    }
    
    // Submit a moderator request
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|min:50|max:500',
        ]);
        
        $user = auth()->user();
        
        // Check if user already has a pending request
        $existingRequest = ModeratorRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();
            
        if ($existingRequest) {
            return redirect()->route('dashboard')->with('error', 'You already have a pending request.');
        }
        
        ModeratorRequest::create([
            'user_id' => $user->id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);
        
        return redirect()->route('dashboard')->with('success', 'Your moderator request has been submitted!');
    }
    
    // Admin view all pending requests
    public function index()
    {
        $requests = ModeratorRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();
            
        return view('admin.moderator-requests', compact('requests'));
    }
    
    // Admin approve a request
    public function approve($id)
    {
        $request = ModeratorRequest::findOrFail($id);
        
        // Update user role to moderator
        $request->user->update(['role' => 'moderator']);
        
        // Update request status
        $request->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'Moderator request approved!');
    }
    
    // Admin reject a request
    public function reject($id)
    {
        $request = ModeratorRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);
        
        return redirect()->back()->with('success', 'Moderator request rejected.');
    }
}
