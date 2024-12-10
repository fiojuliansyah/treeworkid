<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendances.index');
    }

    public function create()
    {
        return view('attendances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'latlong' => 'required',
            'user_id' => 'required',
            'site_id' => 'required',
            'imagein' => 'nullable|image|max:3000',
            'imageout' => 'nullable|image|max:3000',
        ]);
        
        $attendance = new Attendance;
        $attendance->date = $request->date;
        $attendance->latlong = $request->latlong;
        $attendance->user_id = $request->user_id;
        $attendance->site_id = $request->site_id;
        $attendance->clock_in = $request->clock_in;
        $attendance->clock_out = $request->clock_out;

        if ($request->hasFile('imagein')) {
            $cloudinaryImageIn = $request->file('imagein')->storeOnCloudinary('attendances_images');
            $attendance->imagein_url = $cloudinaryImageIn->getSecurePath();
            $attendance->imagein_public_id = $cloudinaryImageIn->getPublicId();
        }

        if ($request->hasFile('imageout')) {
            $cloudinaryImageOut = $request->file('imageout')->storeOnCloudinary('attendances_images');
            $attendance->imageout_url = $cloudinaryImageOut->getSecurePath();
            $attendance->imageout_public_id = $cloudinaryImageOut->getPublicId();
        }

        $attendance->save();

        return redirect()->route('attendances.index')
                         ->with('success', 'Attendance recorded successfully.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'date' => 'required',
            'latlong' => 'required',
            'user_id' => 'required',
            'site_id' => 'required',
            'imagein' => 'nullable|image|max:3000',
            'imageout' => 'nullable|image|max:3000',
        ]);

        $attendance->date = $request->date;
        $attendance->latlong = $request->latlong;
        $attendance->user_id = $request->user_id;
        $attendance->site_id = $request->site_id;
        $attendance->clock_in = $request->clock_in;
        $attendance->clock_out = $request->clock_out;

        if ($request->hasFile('imagein')) {
            Cloudinary::destroy($attendance->imagein_public_id);
            $cloudinaryImageIn = $request->file('imagein')->storeOnCloudinary('attendances_images');
            $attendance->imagein_url = $cloudinaryImageIn->getSecurePath();
            $attendance->imagein_public_id = $cloudinaryImageIn->getPublicId();
        }

        if ($request->hasFile('imageout')) {
            Cloudinary::destroy($attendance->imageout_public_id);
            $cloudinaryImageOut = $request->file('imageout')->storeOnCloudinary('attendances_images');
            $attendance->imageout_url = $cloudinaryImageOut->getSecurePath();
            $attendance->imageout_public_id = $cloudinaryImageOut->getPublicId();
        }

        $attendance->save();

        return redirect()->route('attendances.index')
                         ->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        Cloudinary::destroy($attendance->imagein_public_id);
        Cloudinary::destroy($attendance->imageout_public_id);
        $attendance->delete();

        return redirect()->route('attendances.index')
                         ->with('success', 'Attendance deleted successfully.');
    }
}