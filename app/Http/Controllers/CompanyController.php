<?php

namespace App\Http\Controllers;

use App\Models\Company;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        
        $cloudinaryImage = $request->file('logo')->storeOnCloudinary('companies_logo');
        $url = $cloudinaryImage->getSecurePath();
        $public_id = $cloudinaryImage->getPublicId();
    
        $company = new Company;
        $company->name = $request->name;
        $company->short_name = $request->short_name;
        $company->logo_url = $url;
        $company->logo_public_id = $public_id;
        $company->save();

        return redirect()->route('companies.index')
                        ->with('success', 'Perusahaan <strong>' . $company->name . '</strong> berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        if($request->hasFile('logo')){
            Cloudinary::destroy($company->logo_public_id);
            $cloudinaryImage = $request->file('logo')->storeOnCloudinary('companies_logo');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();

            $company->update([
                'logo_url' => $url,
                'logo_public_id' => $public_id,
            ]);

        }
    
        $company->update([
            'name' => $request->name,
            'short_name' => $request->short_name
        ]);
    
        return redirect()->route('companies.index')
            ->with('success', 'Data perusahaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
    
        Cloudinary::destroy($company->image_public_id);
        $company->delete();
    
        return redirect()->route('companies.index')
            ->with('success', 'Data perusahaan berhasil dihapus');
    }
}
