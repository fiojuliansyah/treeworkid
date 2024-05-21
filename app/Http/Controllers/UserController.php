<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $activities = Activity::where('causer_id', $id)->paginate(10);
        
        // Fetch roles for the specific user being edited
        $userRoles = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRoles', 'activities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
    
        if(isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
    
        $user->update($input);
        $user->assignRole($request->roles);
    
        return redirect()->back()
                        ->with('success', 'Pengguna ' . $user->name . ' berhasil perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()
                        ->with('success', 'Berhasil Dihapus');
    }

    public function updatePersonalData(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
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
    
        return redirect()->back()
                        ->with('success', 'Profil ' . $user->name . ' berhasil diperbarui ');
    }
}
