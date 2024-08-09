<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
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
        $latestAttendance = Attendance::where('user_id', $userId)
            ->latest()
            ->first();

        $clockInStatus = Attendance::where('user_id', $userId)
                        ->whereDate('date', $currentDate)
                        ->whereNotNull('clock_in')
                        ->exists();

        $clockOutStatus = Attendance::where('user_id', $userId)
                        ->whereDate('date', $currentDate)
                        ->whereNotNull('clock_out')
                        ->exists();


        return view('mobiles.home', compact('clockInStatus', 'clockOutStatus', 'latestAttendance'));
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
