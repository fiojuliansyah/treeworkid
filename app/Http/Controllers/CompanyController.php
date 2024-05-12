<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Cloudinary\Cloudinary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        return view('companies.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'max:3000',
        ]); 

        // $folderName = 'logo_perusahaan';
        // $file = Storage::disk('cloudinary')->put(
        //     $folderName . '/' . Str::slug($request->short_name),
        //     $request->file('logo')
        // );
    
        $company = new Company;
        $company->name = $request->name;
        $company->short_name = $request->short_name;
        // $company->logo = $file;
        $company->save();

        return redirect()->route('companies.index')
                        ->with('success', 'Perusahaan <strong>' . $company->name . '</strong> berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        if ($company->logo && $request->hasFile('logo')) {
            $filename = basename($company->logo);
            $publicId = 'logo_perusahaan/'. $company->short_name . '/' . pathinfo($filename, PATHINFO_FILENAME);
            Cloudinary::destroy($publicId);
        }

        if ($request->hasFile('logo')) {
            
            $folderName = 'logo_perusahaan';
            $file = Storage::disk('cloudinary')->put(
                $folderName . '/' . Str::slug($request->short_name),
                $request->file('logo')
            );
    
            $company->logo = $file;
        }
    
        $company->name = $request->name;
        $company->short_name = $request->short_name;
        $company->save();
    
        return redirect()->route('companies.index')
            ->with('success', 'Data perusahaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
    
        if ($company->logo) {
            $filename = basename($company->logo);
            $publicId = 'logo_perusahaan/'. $company->short_name . '/' . pathinfo($filename, PATHINFO_FILENAME);
            Cloudinary::destroy($publicId);
        }

        $company->delete();
    
        return redirect()->route('companies.index')
            ->with('success', 'Data perusahaan berhasil dihapus');
    }
}
