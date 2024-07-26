<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Overtime;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('attendances.overtimes.index');
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
        $today = Carbon::now()->format('Y-m-d');
        $userId = Auth::user()->id;

        $attendance = Attendance::firstOrCreate(
            ['date' => $today, 'user_id' => $userId],
            ['clock_in' => $request->clock_in, 'clock_out' => $request->clock_out]
        );
    
        Overtime::updateOrCreate(
            ['attendance_id' => $attendance->id],
            ['clock_in' => $request->clock_in, 'clock_out' => $request->clock_out]
        );
    
        return redirect()->route('overtimes.index')->with('success', 'Overtime created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Overtime $overtime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Overtime $overtime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Overtime $overtime)
    {
        $attendance = Attendance::find($request->attendance_id);
    
        if ($attendance) {
            $attendance->update([
                'clock_in' => $request->clock_in,
                'clock_out' => $request->clock_out,
            ]);
        }
    
        $overtime->update([
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
        ]);
    
        return redirect()->route('overtimes.index')->with('success', 'Overtime updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Overtime $overtime)
    {
        $overtime->delete();

        return redirect()->route('overtimes.index')->with('success', 'Overtime deleted successfully.');
    }
}
