<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Update the profile.
     */
    public function update(Request $request)
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'avatar_url' => 'nullable|url',
            'avatar_public_id' => 'nullable|string|max:255',
            'avatar_encode' => 'nullable|string',
            'eSign' => 'nullable|string|max:255',
            'employee_nik' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'mother_name' => 'nullable|string|max:255',
            'npwp_number' => 'nullable|string|max:255',
            'marriage_status' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'employee_status' => 'nullable|string|max:255',
            'join_date' => 'nullable|date',
            'resign_date' => 'nullable|date',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile->update($validator->validated());

        return response()->json(['message' => 'Profile updated successfully.', 'profile' => $profile], 200);
    }
}

