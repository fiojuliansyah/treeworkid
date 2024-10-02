<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $currentDate = Carbon::now()->toDateString();

        $latestClockIn = Attendance::where('user_id', $userId)
                        ->whereDate('date', $currentDate)
                        ->whereNotNull('clock_in')
                        ->exists();

        $latestAttendance = Attendance::where('user_id', $userId)
                        ->whereDate('date', $currentDate)
                        ->latest()
                        ->first();

        $latestLeave = Leave::where('user_id', $userId)
                        ->latest()
                        ->first();


        return view('mobiles.home', compact('latestClockIn', 'latestAttendance', 'latestLeave'));
    }

    public function setting()
    {
        return view('mobiles.setting');
    }

    public function getStarted()
    {
        return view('mobiles.walkthrough');
    }
}
