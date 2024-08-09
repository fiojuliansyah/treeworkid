<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\TypeLeave;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MLeaveController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $title = 'Cuti';
        $leaves = Leave::where('user_id', $user->id)
                                ->get();
        return view('mobiles.leaves.index', compact('leaves', 'title'));
    }

    public function create()
    {
        $user = Auth::user();
        $types = TypeLeave::where('site_id', $user->site_id)->get();
        return view('mobiles.leaves.create', compact('types'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $dateNow = Carbon::now()->toDateString();
        $cloudinaryImage = $request->file('image')->storeOnCloudinary('leaves_logo');
        $url = $cloudinaryImage->getSecurePath();
        $public_id = $cloudinaryImage->getPublicId();

        $leave = new Leave;
        $leave->user_id = $user->id;
        $leave->site_id = $user->site_id;
        $leave->type_id = $request->type_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->image_url = $url;
        $leave->image_public_id = $public_id;
        $leave->reason = $request->reason;
        $leave->contact = $request->contact;
        $leave->save();

        $attendance = new Attendance;
        $attendance->date = $leave->start_date;
        $attendance->user_id = $user->id;
        $attendance->site_id = $user->site_id;
        $attendance->leave_id = $leave->id;
        $attendance->save();

        return redirect()->route('leave.index')
                        ->with('success', 'Pengajuan permohonan cuti berhasil diajukan');
    }

    public function show($id)
    {
        $leave = Leave::find($id);
        return view('mobiles.leaves.show', compact('leave'));
    }
}
