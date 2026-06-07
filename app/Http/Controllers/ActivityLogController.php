<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $activityLogs = ActivityLog::with('user')
            ->latest()
            ->paginate(15);

        return view('activity-logs.index', compact('activityLogs'));
    }
}