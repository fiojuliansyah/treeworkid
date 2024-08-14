<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Profile;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;

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
        $existingUser = User::where('nik', $row[0])
                            ->orWhere('employee_nik', $row[1])
                            ->orWhere('email', $row[2])
                            ->first();

        if ($existingUser) {
            $existingUser->update([
                'nik' => $row[0],
                'employee_nik' => $row[1],   // Row 1
                'name' => $row[3],
                'phone' => $row[4],
                'password' => bcrypt($row[5]),
                'department_id' => $row[6],  // Row 6
                'leader_id' => $row[7],      // Row 7
                'site_id' => $row[8],        // Row 8
                'is_employee' => $row[9],    // Row 9
            ]);
            $user = $existingUser;
        } else {
            $user = User::create([
                'nik' => $row[0],
                'employee_nik' => $row[1],   // Row 1
                'email' => $row[2],
                'name' => $row[3],
                'phone' => $row[4],
                'password' => bcrypt($row[5]),
                'department_id' => $row[6],  // Row 6
                'leader_id' => $row[7],      // Row 7
                'site_id' => $row[8],        // Row 8
                'is_employee' => $row[9],    // Row 9
            ]);
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


