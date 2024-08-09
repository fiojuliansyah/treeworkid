<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Career;
use App\Models\Status;
use App\Models\Document;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $careerCount = Career::count();
        $siteCount = Site::count();
        $applicantCount = Applicant::count();
        $userCount = User::where('is_employee', 1)->count();
        return view('dashboards.dashboard', compact('siteCount', 'careerCount', 'userCount', 'applicantCount'));
    }

    public function recruit()
    {
        $career = Career::count();
        $applicant = Applicant::whereNull('done')
                        ->where('status_id', 0)
                        ->count();
        
        $statuses = Status::all();

        $applicantCounts = [];
        foreach ($statuses as $status) {
            $applicantCounts[$status->id] = Applicant::where('status_id', $status->id)
                                        ->whereNotNull('approve_id')
                                        ->whereNull('done')
                                        ->count();
        }

        return view('dashboards.recruit', compact('statuses', 'applicant', 'applicantCounts', 'career'));
    }
    
    public function activities()
    {
        return view('dashboards.activities');
    } 

    public function welcome()
    {
        return view('landing');
    }

    public function career()
    {
        return view('website.careers.index');
    }
    
    public function careerDetail($id)
    {
        $user = Auth::user();
        $documents = $user ? Document::where('user_id', $user->id)->get() : collect();

        $ID = decrypt($id);
        $career = Career::find($ID);
        return view('website.careers.detail',compact('career','user','documents'));
    }

    public function indexAccount()
    {
        $sites = Site::all();
        $user = Auth::user();
        return view('website.profiles.index',compact('user','sites'));
    }

    public function indexProfile()
    {
        $user = Auth::user();
        return view('website.profiles.profile',compact('user'));
    }

    public function indexDocument()
    {
        $user = Auth::user();
        $documents = Document::where('user_id', $user->id)->get();
        return view('website.profiles.document',compact('user','documents'));
    }
}
