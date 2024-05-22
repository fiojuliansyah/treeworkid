<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('applicants.index');
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
        $user = Auth::user()->id;

        $applicant = new Applicant;
        $applicant->user_id = $user;
        $applicant->career_id = $request->career_id;
        $applicant->status_id = '0';
        $applicant->save();

        return redirect()->route('web-career')
                        ->with('success', 'Career ' . $applicant->user['name'] . ' berhasil dibuat');
    }


    public function show(Applicant $applicant)
    {
        
    }

    public function updateStatus(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $newStatus = $request->status_id;

        if ($newStatus) {
            $status = Status::findOrFail($newStatus);

            $applicantData = [
                'user_id' => $applicant->user_id,
                'career_id' => $applicant->career_id,
                'status_id' => $newStatus,
            ];

            if ($status->is_approve == 0) {
                $applicantData['approve_id'] = '0';
            }

            Applicant::create($applicantData);
        }

        $applicant->done = 'done';
        $applicant->save();

        return redirect()->back()->with('success', 'Applicant berhasil diperbarui');
    }


    public function updateApprove(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $applicant->approve_id = $request->approve_id;
        $applicant->update();

        return redirect()->back()
                        ->with('success', 'Applicant berhasil diperbarui');
    }

}
