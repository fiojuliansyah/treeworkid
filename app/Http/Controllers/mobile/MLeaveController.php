<?php

namespace App\Http\Controllers\mobile;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MLeaveController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $title = 'Cuti';
        $leaves = Leave::where('user_id', $userId)
                                ->get();
        return view('mobiles.leaves.index', compact('leaves', 'title'));
    }
}
