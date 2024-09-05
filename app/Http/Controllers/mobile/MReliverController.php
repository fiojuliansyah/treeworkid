<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
use App\Models\Site;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MReliverController extends Controller
{
    public function index()
    {
        $title = 'Reliver';
        $user = Auth::user();
        $userId = $user->id;
        $users = User::where('site_id', $user->site_id)->get();
        $sites = Site::all();
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

        $logs = Attendance::where('user_id', $userId)
                        ->where('is_reliver', 1)
                        ->orderBy('date', 'desc') 
                        ->paginate(1); 

        return view('mobiles.relivers.index', compact('clockInStatus', 'clockOutStatus', 'latestAttendance', 'logs', 'title', 'sites', 'users', 'user'));
    }

    public function updateSite(Request $request)
    {
        $user = Auth::user();
        $user->site_id = $request->site_id;
        $user->save();
    
        return response()->json(['success' => 'Site updated successfully.']);
    }

    public function clockin(Request $request)
    {
        $user = Auth::user();
        $dateNow = Carbon::now()->toDateString();
        $timeNow = Carbon::now()->toTimeString();

        $attendance = new Attendance;
        $attendance->date = $dateNow;
        $attendance->user_id = $user->id;
        $attendance->site_id = $user->site_id;
        $attendance->is_reliver = 1;
        $attendance->type = $request->type;
        $attendance->backup_id = $request->backup_id;
        $attendance->remark = $request->remark;
        $attendance->save();

        return view('mobiles.relivers.clockin')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Cache-Control', 'post-check=0, pre-check=0')
        ->header('Pragma', 'no-cache');
    }

    public function clockinStore(Request $request)
    {
        $user = Auth::user();

        $dateNow = Carbon::now()->toDateString();
        $timeNow = Carbon::now()->toTimeString();

        $lastAttendance = Attendance::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastAttendance) {
        $lastAttendance->latlong = $request->latlong;
        $lastAttendance->clock_in = $timeNow;
            if ($request->image) {
                $imageData = $request->input('image');
                
                list($type, $imageData) = explode(';', $imageData);
                list(, $imageData)      = explode(',', $imageData);
                
                $imageData = 'data:image/png;base64,' . $imageData;

                $cloudinaryImageIn = Cloudinary::upload($imageData, [
                    'folder' => 'attendances_images'
                ]);

                $lastAttendance->imagein_url = $cloudinaryImageIn->getSecurePath();
                $lastAttendance->imagein_public_id = $cloudinaryImageIn->getPublicId();
            }
        }
        $lastAttendance->save();

        return redirect()->route('reliver.index')
                             ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                            ->header('Cache-Control', 'post-check=0, pre-check=0')
                            ->header('Pragma', 'no-cache')
                         ->with('success', 'Attendance recorded successfully.');
    }

    public function clockout()
    {
        return view('mobiles.relivers.clockout');
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

        return redirect()->route('reliver.index')
                         ->with('success', 'Attendance recorded successfully.');
    }
}
