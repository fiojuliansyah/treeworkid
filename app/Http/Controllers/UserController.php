<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    public function indexAccount($id)
    {
        $ID = decrypt($id);
        $user = User::findOrFail($ID);
        $users = User::All();
        $sites = Site::all();
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('users.profiles.index',compact('user','users','sites','roles','userRoles'));
    }

    public function indexProfile($id)
    {
        $ID = decrypt($id);
        $user = User::findOrFail($ID);
        return view('users.profiles.profile',compact('user'));
    }

    public function indexDocument($id)
    {
        $ID = decrypt($id);
        $user = User::findOrFail($ID);
        $documents = Document::where('user_id', $user->id)->get();
        return view('users.profiles.document',compact('user','documents'));
    }

    public function indexActivities($id)
    {
        $ID = decrypt($id);
        $user = User::findOrFail($ID);
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
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->back()
                        ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'image|mimes:png,jpg,jpeg|max:2048',
            'employee_nik' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|in:Laki-Laki,Perempuan',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'mother_name' => 'required|string|max:255',
            'npwp_number' => 'required|string|max:255',
            'marriage_status' => 'required|string|in:TK-0,TK-1,TK-2,TK-3,K-0,K-1,K-2,K-3',
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $profileData = $request->only([
            'employee_nik', 'address', 'gender', 'birth_place', 'birth_date', 'mother_name', 'npwp_number', 'marriage_status', 'bank_name', 'account_name', 'account_number'
        ]);

        if ($request->hasFile('avatar')) {
            $cloudinaryImage = $request->file('avatar')->storeOnCloudinary('avatars');
            $profileData['avatar_url'] = $cloudinaryImage->getSecurePath();
            $profileData['avatar_public_id'] = $cloudinaryImage->getPublicId();
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        return redirect()->back()->with('success', 'Profil ' . $user->name . ' berhasil diperbarui');
    }

    public function storeDocument(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'name' => 'required|string|max:255',
        ]);
    
        $cloudinaryFile = $request->file('file')->storeOnCloudinary('Documents');
        $url = $cloudinaryFile->getSecurePath();
        $public_id = $cloudinaryFile->getPublicId();
    
        $document = new Document;
        $document->user_id = $user->id;
        $document->name = $request->name;
        $document->description = $request->description ?? null;
        $document->validate = $request->validate ?? null;
        $document->file_url = $url;
        $document->file_public_id = $public_id;
        $document->save();
    
        return redirect()->back()->with('success', 'Dokumen ' . $document->name . ' berhasil diunggah');
    }
    


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()
                        ->with('success', 'Berhasil Dihapus');
    }
}
