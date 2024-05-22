<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Letter;
use App\Models\Generate;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function index()
    {
        return view('generates.index');
    }

    public function create()
    {
        $users = User::all();
        $letters = Letter::all();
        $descriptions = Letter::pluck('description', 'id')->toArray();
        return view('generates.create',compact('users','letters'));
    }

    public function store(Request $request)
    {
        $generate = new Generate;
        $generate->letter_id = $request->letter_id;
        $generate->user_id = $request->user_id;
        $generate->save();
    
        $generate->description = $generate->letter->description;
        $generate->save();
        
        return redirect()->route('letter-regenerate', encrypt($generate->id))
                        ->with('success', 'Letter ' . $generate->user->name . ' berhasil digenerate');
    }
    

    public function regenerate($id)
    {
        $ID = decrypt($id);
        $generate = Generate::find($ID);
        $users = User::all();
        $letters = Letter::all();
        return view('generates.regenerate',compact('generate','users','letters'));
    }

    public function update(Request $request, $id)
    {
        $generate = Generate::find($id);
        $generate->letter_id = $request->letter_id;
        $generate->user_id = $request->user_id;
        $generate->description = $request->description;
        $generate->save();

        return redirect()->back()
                        ->with('success', 'Letter ' . $generate->user['name'] . ' berhasil digenerate');
    }
}
