<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Profile;
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
    public function index()
    {
        $sites = Site::all();
        $user = Auth::user();
        return view('profiles.index',compact('user','sites'));
    }

    public function update(Request $request)
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
    
        return redirect()->route('profiles.index')
                        ->with('success', 'Profil <strong>' . $user->name . '</strong> berhasil diperbarui');
    }

    public function updatePersonalData(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
    
        // Simpan avatar baru jika ada
        if ($request->hasFile('avatar')) {
            $cloudinaryImage = $request->file('avatar')->storeOnCloudinary('avatars');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();
    
            // Update avatar dan data profil sekaligus
            $user->profile()->update([
                'avatar_url' => $url,
                'avatar_public_id' => $public_id,
                'user_id' => $user->id,
                'avatar_encode' => $avatarEncoded ?? null,
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
            ]);
        } else {
            // Jika tidak ada avatar baru, cukup update data profil saja
            $user->profile()->update([
                'user_id' => $user->id,
                'avatar_encode' => $avatarEncoded ?? null,
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
            ]);
        }
    
        return redirect('/dashboard')->withInput();
    }
     
}
