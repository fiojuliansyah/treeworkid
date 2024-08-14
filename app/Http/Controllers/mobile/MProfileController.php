<?php

namespace App\Http\Controllers\mobile;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MProfileController extends Controller
{
    public function account()
    {
        $user = Auth::user();
        $title = 'Akun';
        return view('mobiles.profiles.account', compact('user', 'title'));
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
    
        return redirect()->route('mobile.setting')
                        ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function profile()
    {
        $user = Auth::user();
        $title = 'Profilku';
        return view('mobiles.profiles.profile', compact('user', 'title'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile()->first();
    
        if ($request->hasFile('avatar')) {
            $cloudinaryImage = $request->file('avatar')->storeOnCloudinary('avatars');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();
    
            $data = [
                'avatar_url' => $url,
                'avatar_public_id' => $public_id,
                'avatar_encode' => $avatarEncoded ?? null,
            ];
        } else {
            $data = [
                'avatar_encode' => $avatarEncoded ?? null,
            ];
        }
    
        $data += [
            'address' => $request->address,
            'gender' => $request->gender,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'mother_name' => $request->mother_name,
            'npwp_number' => $request->npwp_number,
            'marriage_status' => $request->marriage_status,
        ];
    
        if ($profile) {
            $profile->update($data);
        } else {
            $user->profile()->create($data);
        }
    
        return redirect()->route('mobile.setting')
                         ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function bank()
    {
        $user = Auth::user();
        $title = 'Bank';
        return view('mobiles.profiles.bank', compact('user', 'title'));
    }

    public function updateBank(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile()->first();
    
        $data = [
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
        ];
        
        if ($profile) {
            $profile->update($data);
        } else {
            $user->profile()->create($data);
        }
        
        return redirect()->route('mobile.setting')
                         ->with('success', 'Bank ' . $user->name . ' berhasil diperbarui');
    }

    public function esign()
    {
        $user = Auth::user();
        $title = 'E-Sign';
        return view('mobiles.profiles.esign', compact('user', 'title'));
    }

    public function updateEsign(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile()->first();
        
        if ($request->esign) {
            $imageData = $request->input('esign');
            
            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData)      = explode(',', $imageData);
            
            $imageData = 'data:image/png;base64,' . $imageData;
    
            $cloudinaryImageIn = Cloudinary::upload($imageData, [
                'folder' => 'esign_images'
            ]);
    
            $esignUrl = $cloudinaryImageIn->getSecurePath();
            $esignPublicId = $cloudinaryImageIn->getPublicId();
    
            if ($profile) {
                $profile->esign_url = $esignUrl;
                $profile->esign_public_id = $esignPublicId;
                $profile->save();
            } else {
                $user->profile()->create([
                    'esign_url' => $esignUrl,
                    'esign_public_id' => $esignPublicId
                ]);
            }
        }
    
        return redirect()->route('mobile.setting')
                            ->with('success', 'Tanda Tangan ' . $user->name . ' berhasil diperbarui');
    }    
    
    
}
