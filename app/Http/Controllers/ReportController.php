<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Submit laporan untuk Post
    public function reportPost(Request $request, Post $post)
    {
        $request->validate([
            'reason' => 'required|in:spam,harassment,inappropriate,offensive,other',
            'description' => 'nullable|string|max:500',
        ]);

        // Check if already reported
        $existingReport = Report::where('user_id', auth()->id())
            ->where('reportable_id', $post->id)
            ->where('reportable_type', Post::class)
            ->first();

        if ($existingReport) {
            return back()->with('error', 'You have already reported this post.');
        }

        Report::create([
            'user_id' => auth()->id(),
            'reportable_id' => $post->id,
            'reportable_type' => Post::class,
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Report submitted. Our moderators will review it.');
    }

    // Submit laporan untuk Reply
    public function reportReply(Request $request, Reply $reply)
    {
        $request->validate([
            'reason' => 'required|in:spam,harassment,inappropriate,offensive,other',
            'description' => 'nullable|string|max:500',
        ]);

        // Check if already reported
        $existingReport = Report::where('user_id', auth()->id())
            ->where('reportable_id', $reply->id)
            ->where('reportable_type', Reply::class)
            ->first();

        if ($existingReport) {
            return back()->with('error', 'You have already reported this reply.');
        }

        Report::create([
            'user_id' => auth()->id(),
            'reportable_id' => $reply->id,
            'reportable_type' => Reply::class,
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Report submitted. Our moderators will review it.');
    }

    // View all reports (Moderator/Admin only)
    public function index()
    {
        $reports = Report::with(['reporter', 'reportable', 'reviewer'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.reports', compact('reports'));
    }

    // Mark report as reviewed
    public function review($id)
    {
        $report = Report::findOrFail($id);
        
        $report->update([
            'status' => 'reviewed',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Report marked as reviewed.');
    }

    // Resolve report (and optionally delete content)
    public function resolve(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        
        if ($request->has('delete_content')) {
            // Delete the reported content
            $report->reportable->delete();
        }
        
        $report->update([
            'status' => 'resolved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Report resolved.');
    }

    // Dismiss report
    public function dismiss($id)
    {
        $report = Report::findOrFail($id);
        
        $report->update([
            'status' => 'dismissed',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Report dismissed.');
    }
}
