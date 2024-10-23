<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Profile;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Spatie\Permission\Models\Role;

class EmployeeImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        if ($row[0] === 'nik' && $row[1] === 'employee_nik') {
            return null;
        }

        if ($row[0] === null) {
            return null;
        }

        // Mencari pengguna yang sudah ada berdasarkan nik, employee_nik, dan email
        $user = User::where('nik', $row[0])
                    ->orWhere('employee_nik', $row[1])
                    ->orWhere('email', $row[2])
                    ->first();

        if ($user) {
            // Update existing user data
            $user->update([
                'nik' => $row[0],
                'employee_nik' => $row[1],
                'name' => $row[3],
                'phone' => $row[4],
                'password' => bcrypt($row[5]),
                'department_id' => $row[6],
                'leader_id' => $row[7],
                'site_id' => $row[8],
                'is_employee' => $row[9],
            ]);
        } else {
            // Create a new user if not found
            $user = User::create([
                'nik' => $row[0],
                'employee_nik' => $row[1],
                'email' => $row[2],
                'name' => $row[3],
                'phone' => $row[4],
                'password' => bcrypt($row[5]),
                'department_id' => $row[6],
                'leader_id' => $row[7],
                'site_id' => $row[8],
                'is_employee' => $row[9],
            ]);
        }

        // Role assignment using Spatie
        $roleIdentifier = $row[22]; // Assuming role name or role ID is in column 23 (index 22)

        // Check if the identifier is a numeric ID or string (role name)
        if (is_numeric($roleIdentifier)) {
            $role = Role::findById($roleIdentifier);
        } else {
            $role = Role::findByName($roleIdentifier, 'web'); // Ensure you're using the correct guard, e.g., 'web'
        }

        // Handle missing role case
        if ($role) {
            $user->syncRoles([$role]); // Sync roles for the user
        } else {
            // Log or handle the missing role case
            // For example: Log::warning("Role not found: $roleIdentifier");
            throw new \Exception("Role not found: $roleIdentifier");
        }

        // Handle Profile creation/update
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $row[10],
                'birth_place' => $row[11],
                'birth_date' => Date::excelToDateTimeObject($row[12])->format('Y-m-d'),
                'marriage_status' => $row[13],
                'mother_name' => $row[14],
                'gender' => $row[15],
                'weight' => $row[16],
                'height' => $row[17],
                'bank_name' => $row[18],
                'account_name' => $row[19],
                'account_number' => $row[20],
                'npwp_number' => $row[21],
            ]
        );

        return $user;
    }

    public function startRow(): int
    {
        return 2;
    }
}
