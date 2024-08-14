<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MAttendanceController extends Controller
{
    public function index()
    {
        $title = 'Prensensi';
        $userId = Auth::id();
        $currentDate = Carbon::now()->toDateString();
        $latestAttendance = Attendance::where('user_id', $userId)
            ->latest()
            ->first();

        $latestClockIn = Attendance::where('user_id', $userId)
            ->whereDate('date', $currentDate)
            ->whereNotNull('clock_in')
            ->exists();

        $latestClockOut = Attendance::where('user_id', $userId)
            ->whereDate('date', $currentDate)
            ->whereNotNull('clock_out')
            ->exists();

        $logs = Attendance::where('user_id', $userId)
                        ->orderBy('date', 'desc') 
                        ->paginate(1); 

        return view('mobiles.attendances.index', compact('latestClockIn', 'latestClockOut', 'latestAttendance', 'logs', 'title'));
    }

    public function timeOff(Request $request)
    {
        $user = Auth::user();

        $dateNow = Carbon::now()->toDateString();
        $timeNow = Carbon::now()->toTimeString();

        $attendance = new Attendance;
        $attendance->date = $dateNow;
        $attendance->user_id = $user->id;
        $attendance->site_id = $user->site_id;
        $attendance->clock_in = $timeNow;
        $attendance->clock_out = $timeNow;
        $attendance->type = 'shift_off';

        $attendance->save();

        return redirect()->route('mobile.home')
                         ->with('success', 'Attendance recorded successfully.');
    }

    public function clockin()
    {
        return view('mobiles.attendances.clockin');
    }

    public function clockinStore(Request $request)
    {
        $user = Auth::user();

        $dateNow = Carbon::now()->toDateString();
        $timeNow = Carbon::now()->toTimeString();

        $attendance = new Attendance;
        $attendance->date = $dateNow;
        $attendance->latlong = $request->latlong;
        $attendance->user_id = $user->id;
        $attendance->site_id = $user->site_id;
        $attendance->clock_in = $timeNow;

        if ($request->image) {
            $imageData = $request->input('image');
            
            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData)      = explode(',', $imageData);
            
            $imageData = 'data:image/png;base64,' . $imageData;

            $cloudinaryImageIn = Cloudinary::upload($imageData, [
                'folder' => 'attendances_images'
            ]);

            $attendance->imagein_url = $cloudinaryImageIn->getSecurePath();
            $attendance->imagein_public_id = $cloudinaryImageIn->getPublicId();
        }

        $attendance->save();

        return redirect()->route('mobile.home')
                         ->with('success', 'Attendance recorded successfully.');
    }

    public function clockout()
    {
        return view('mobiles.attendances.clockout');
    }

    public function clockoutStore(Request $request)
    {
        $user = Auth::user();

        $dateNow = Carbon::now()->toDateString();
        $timeNow = Carbon::now()->toTimeString();

        $lastAttendance = Attendance::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastAttendance) {
            $lastAttendance->clock_out = $timeNow;

            if ($request->image) {
                $imageData = $request->input('image');
                
                list($type, $imageData) = explode(';', $imageData);
                list(, $imageData)      = explode(',', $imageData);
                
                $imageData = 'data:image/png;base64,' . $imageData;

                $cloudinaryImageIn = Cloudinary::upload($imageData, [
                    'folder' => 'attendances_images'
                ]);

                $lastAttendance->imageout_url = $cloudinaryImageIn->getSecurePath();
                $lastAttendance->imageout_public_id = $cloudinaryImageIn->getPublicId();
            }
            $lastAttendance->save();
        }

        return redirect()->route('mobile.home')
                         ->with('success', 'Attendance recorded successfully.');
    }

    public function logs()
    {
        $userId = Auth::id();
        $logs = Attendance::where('user_id', $userId)
                           ->where('created_at', '>=', now()->subDays(7))
                           ->orderBy('created_at', 'DESC')
                           ->get();
        return view('mobiles.attendances.logs', compact('logs'));
    }
}

