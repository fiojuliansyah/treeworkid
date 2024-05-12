<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Company;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('sites.index');
    }

    public function store(Request $request)
    {
        $site = new Site;
        $site->company_id = $request->company_id;
        $site->name = $request->name;
        $site->description = $request->description;
        $site->lat = $request->lat;
        $site->long = $request->long;
        $site->radius = $request->radius;
        $site->save();

        return redirect()->route('sites.index')
                        ->with('success', 'Lokasi <strong>' . $site->name . '</strong> berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $site = Site::findOrFail($id);
        $site->company_id = $request->company_id;
        $site->name = $request->name;
        $site->description = $request->description;
        $site->lat = $request->lat;
        $site->long = $request->long;
        $site->radius = $request->radius;

        $site->update();

        return redirect()->route('sites.index')
                        ->with('success', 'Lokasi <strong>' . $site->name . '</strong> berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $site = Site::findOrFail($id);
        $site->delete();
    
        return redirect()->route('sites.index')
            ->with('success', 'Data Lokasi berhasil dihapus');
    }

    public function addCheckpoint($id)
    {
        $site = Site::find($id);
        return view('checkpoints.checkpoint',compact('site'));

    }

}
