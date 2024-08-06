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

        $logs = Attendance::paginate(5);

        return view('mobiles.attendances.index', compact('clockInStatus', 'clockOutStatus', 'latestAttendance', 'logs'));
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

        return redirect()->route('attendance.index')
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

        return redirect()->route('attendance.index')
                         ->with('success', 'Attendance recorded successfully.');
    }
}

