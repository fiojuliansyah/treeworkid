<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function index()
    {
        return view('statuses.index');
    }

    public function store(Request $request)
    {
        $status = new Status;
        $status->color = $request->color;
        $status->name = $request->name;
        $status->save();

        return redirect()->route('statuses.index')
                        ->with('success', 'Status ' . $status->name . ' berhasil dibuat');
    }

    public function show($name)
    {
        $status = Status::where('name', $name)->first();
        return view('statuses.show', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);
        $status->color = $request->color;
        $status->name = $request->name;

        $status->update();

        return redirect()->route('statuses.index')
                        ->with('success', 'Status ' . $status->name . ' berhasil diperbarui');
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
    
        return redirect()->route('statuses.index')
            ->with('success', 'Data Lokasi berhasil dihapus');
    }
}
