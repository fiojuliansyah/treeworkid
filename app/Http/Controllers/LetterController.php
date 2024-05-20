<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('letters.index');
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
        $letter = new Letter;
        $letter->site_id = $request->site_id;
        $letter->title = $request->title;
        $letter->description = $request->description;
        $letter->save();

        return redirect()->back()
                        ->with('success', 'Letter ' . $letter->title . ' berhasil dibuat');
    }


    public function update(Request $request, $id)
    {
        $letter = Letter::findOrFail($id);
        $letter->site_id = $request->site_id;
        $letter->title = $request->title;
        $letter->description = $request->description;
        $letter->save();

        return redirect()->back()
                        ->with('success', 'Letter ' . $letter->title . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);
        $letter->delete();
    
        return redirect()->back()
            ->with('success', 'Data Letter berhasil dihapus');
    }
}
