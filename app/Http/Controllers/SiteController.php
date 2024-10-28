<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Company;
use App\Imports\SiteImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $site->client_name = $request->client_name;
        $site->client_phone = $request->client_phone;
        $site->client_email = $request->client_email;
        $site->save();

        return redirect()->back()
                        ->with('success', 'Lokasi ' . $site->name . ' berhasil dibuat');
    }

    public function edit($id)
    {
        $companies = Company::all();
        $site = Site::findOrFail($id);
        return view('sites.edit', compact('site', 'companies'));
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
        $site->client_name = $request->client_name;
        $site->client_phone = $request->client_phone;
        $site->client_email = $request->client_email;

        $site->update();

        return redirect()->route('sites.index')
                        ->with('success', 'Lokasi ' . $site->name . ' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $site = Site::find($id);
        $site->delete();
    
        return redirect()->back()
            ->with('success', 'Data Lokasi berhasil dihapus');
    }

    public function addCheckpoint($id)
    {
        $site = Site::find($id);
        return view('checkpoints.checkpoint',compact('site'));

    }

    public function import(Request $request)
    {
        Excel::import(new SiteImport, $request->file('file')->store('files'));
        return redirect()->back();
    }

}
