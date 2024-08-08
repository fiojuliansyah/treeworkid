<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
use App\Models\Minute;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MMinuteController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $title = 'Berita Acara';
        $minutes = Attendance::where('type', 'berita_acara')
                                ->where('user_id', $userId)
                                ->get();
        return view('mobiles.minutes.index', compact('minutes', 'title'));
    }

    public function create()
    {
        return view('mobiles.minutes.create');
    }

    public function minute(Request $request)
    {
        $user = Auth::user();
    
        $dateNow = Carbon::now()->toDateString();
        $timeNow = Carbon::now()->toTimeString();
    
        $imgUrl = $request->hasFile('image') ? $request->file('image')->storeOnCloudinary('minutes')->getSecurePath() : null;
        $imgPublicId = $request->hasFile('image') ? $request->file('image')->storeOnCloudinary('minutes')->getPublicId() : null;
    
        $lastAttendance = Attendance::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if ($request->type === 'clockin') {
    
            $attendance = new Attendance;
            $attendance->date = $request->date;
            $attendance->latlong = $request->latlong;
            $attendance->user_id = $user->id;
            $attendance->site_id = $user->site_id;
            $attendance->clock_in = $request->clock;
            $attendance->type = 'berita_acara';
            $attendance->imagein_url = $imgUrl;
            $attendance->imagein_public_id = $imgPublicId;
            $attendance->remark = $request->remark;
            $attendance->save();
    
        } elseif ($request->type === 'clockout') {
    
            if ($lastAttendance) {
                $lastAttendance->clock_out = $request->clock;
                $lastAttendance->imageout_url = $imgUrl;
                $lastAttendance->imageout_public_id = $imgPublicId;
                $lastAttendance->remark = $request->remark;
                $lastAttendance->save();
            } else {
                return redirect()->route('minute.index')
                                 ->with('error', 'No clock-in record found. Please clock in first.');
            }
        }
    
        return redirect()->route('minute.index')
                         ->with('success', 'Minute recorded successfully.');
    }
    
    public function show($id)
    {
        $minute = Attendance::find($id);
        return view('mobiles.minutes.show', compact('minute'));
    }

}
