<?php

namespace App\Http\Controllers\mobile;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\TypeLeave;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

    public function createLeave($slug)
    {
        $user = Auth::user();
        $typeLeave = TypeLeave::where('slug', $slug)->firstOrFail();
    
        return view('mobiles.leaves.parts.leave', compact('typeLeave', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $dateNow = Carbon::now()->toDateString();
        
            // Check if the image was uploaded
        if ($request->hasFile('image')) {
            // Store the image on Cloudinary and get the URL and public ID
            $cloudinaryImage = $request->file('image')->storeOnCloudinary('leaves_logo');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();
        } else {
            // If no image uploaded, set URL and public ID to null
            $url = null;
            $public_id = null;
        }

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
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);
    
        $leave = Leave::findOrFail($id);
    
        // Update hanya input yang tersedia dalam request
        $leave->update($request->only([
            'user_id',
            'site_id',
            'start_date',
            'end_date',
            'reason',
            'contact'
        ]));
    
        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            if (!empty($leave->image_public_id)) {
                Cloudinary::destroy($leave->image_public_id); // Hapus gambar lama jika ada
            }
            $cloudinaryImage = $request->file('image')->storeOnCloudinary('leaves_images');
            $leave->image_url = $cloudinaryImage->getSecurePath();
            $leave->image_public_id = $cloudinaryImage->getPublicId();
            $leave->save(); // Simpan ulang jika ada perubahan pada gambar
        }
    
        return redirect()->route('mobile.home')
                         ->with('success', 'Leave successfully updated.');
    }

    public function show($id)
    {
        $leave = Leave::find($id);
        return view('mobiles.leaves.show', compact('leave'));
    }
}
