<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Profile;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAccount()
    {
        $sites = Site::all();
        $user = Auth::user();
        return view('profiles.index',compact('user','sites'));
    }

    public function indexProfile()
    {
        $user = Auth::user();
        return view('profiles.profile',compact('user'));
    }

    public function indexDocument()
    {
        $user = Auth::user();
        $documents = Document::where('user_id', $user->id)->get();
        return view('profiles.document',compact('user','documents'));
    }

    public function updateAccount(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $input = $request->all();
    
        if(isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
    
        $user->update($input);
    
        return redirect()->back()
                        ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile()->first();
    
        if ($request->hasFile('avatar')) {
            $cloudinaryImage = $request->file('avatar')->storeOnCloudinary('avatars');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();

            Cloudinary::destroy($user->avatar_public_id);

            $data = [
                'avatar_url' => $url,
                'avatar_public_id' => $public_id,
            ];
        }
    
        $data += [
            'employee_nik' => $request->employee_nik,
            'address' => $request->address,
            'gender' => $request->gender,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'mother_name' => $request->mother_name,
            'npwp_number' => $request->npwp_number,
            'marriage_status' => $request->marriage_status,
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
        ];
    
        if ($profile) {
            $profile->update($data);
        } else {
            $user->profile()->create($data);
        }
    
        return redirect()->back()
                        ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function storeDocument(Request $request)
    {
        $user = Auth::user()->id;

        $request->validate([
            'file' => 'required',
            'name' => 'required',
        ]); 
        
        $cloudinaryFile = $request->file('file')->storeOnCloudinary('Documents');
        $url = $cloudinaryFile->getSecurePath();
        $public_id = $cloudinaryFile->getPublicId();
    
        $document = new Document;
        $document->user_id = $user;
        $document->name = $request->name;
        $document->description = $request->description;
        $document->validate = $request->validate;
        $document->file_url = $url;
        $document->file_public_id = $public_id;
        $document->save();

        return redirect()->back()
                        ->with('success', 'Perusahaan ' . $document->name . ' berhasil dibuat');
    }
}
