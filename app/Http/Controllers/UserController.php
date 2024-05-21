<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function indexAccount($id)
    {
        $user = User::findOrFail($id);
        $users = User::All();
        $sites = Site::all();
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('users.profiles.index',compact('user','users','sites','roles','userRoles'));
    }

    public function indexProfile($id)
    {
        $user = User::findOrFail($id);
        return view('users.profiles.profile',compact('user'));
    }

    public function indexDocument($id)
    {
        $user = User::findOrFail($id);
        $documents = Document::where('user_id', $user->id)->get();
        return view('users.profiles.document',compact('user','documents'));
    }

    public function indexActivities($id)
    {
        $user = User::findOrFail($id);
        $activities = Activity::where('causer_id', $id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('users.profiles.activities',compact('user','activities'));
    }

    public function updateAccount(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
    
        if(isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
    
        $user->update($input);
        $user->assignRole($request->roles);
    
        return redirect()->back()
                        ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        if ($request->hasFile('avatar')) {
            $cloudinaryImage = $request->file('avatar')->storeOnCloudinary('avatars');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();
    
            $user->profile()->updateOrCreate([
                'user_id' => $user->id,
                'avatar_url' => $url,
                'avatar_public_id' => $public_id,
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
            $user->profile()->updateOrCreate([
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
    
        return redirect()->back()
                        ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function storeDocument(Request $request, $id)
    {
        $user = User::findOrFail($id);

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


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()
                        ->with('success', 'Berhasil Dihapus');
    }
}
