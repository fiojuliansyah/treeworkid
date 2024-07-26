<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('attendances.leaves.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'site_id' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'nullable|string',
            'contact' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $leave = new Leave;
        $leave->user_id = $request->user_id;
        $leave->site_id = $request->site_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->reason = $request->reason;
        $leave->contact = $request->contact;

        if ($request->hasFile('image')) {
            $cloudinaryImage = $request->file('image')->storeOnCloudinary('leaves_images');
            $leave->image_url = $cloudinaryImage->getSecurePath();
            $leave->image_public_id = $cloudinaryImage->getPublicId();
        }

        $leave->save();

        return redirect()->route('leaves.index')
                        ->with('success', 'Leave successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|string',
            'site_id' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'nullable|string',
            'contact' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $leave = Leave::findOrFail($id);
        $leave->user_id = $request->user_id;
        $leave->site_id = $request->site_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->reason = $request->reason;
        $leave->contact = $request->contact;

        if ($request->hasFile('image')) {
            Cloudinary::destroy($leave->image_public_id);
            $cloudinaryImage = $request->file('image')->storeOnCloudinary('leaves_images');
            $leave->image_url = $cloudinaryImage->getSecurePath();
            $leave->image_public_id = $cloudinaryImage->getPublicId();
        }

        $leave->save();

        return redirect()->route('leaves.index')
                        ->with('success', 'Leave successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);

        if ($leave->image_public_id) {
            Cloudinary::destroy($leave->image_public_id);
        }

        $leave->delete();

        return redirect()->route('leaves.index')
                        ->with('success', 'Leave successfully deleted.');
    }
}
