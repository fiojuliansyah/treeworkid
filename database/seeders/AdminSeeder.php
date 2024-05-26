<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin Seeder
        $admin = User::create([
            'name' => 'Super Admin', 
            'email' => 'admin@gmail.com',
            'nik' => '326122166262',
            'phone' => '081212082958',
            'leader_id' => '2',
            'password' => bcrypt('password')
        ]);

        $role = Role::create(['name' => 'App Administrator']);
        
        $permissions = Permission::pluck('id','id')->all();
        
        $role->syncPermissions($permissions);
        
        $admin->assignRole([$role->id]);

        // Generate API token for admin
        $adminToken = $admin->createToken('AdminToken')->plainTextToken;
        echo "Admin Token: " . $adminToken . "\n";

        // Create Dummy Users
        $userDummy = User::create([
            'name' => 'Dummy user', 
            'email' => 'dummy@gmail.com',
            'nik' => '326122166523423',
            'phone' => '0812142208258',
            'leader_id' => '3',
            'password' => bcrypt('password')
        ]);

        $dummyToken = $userDummy->createToken('DummyToken')->plainTextToken;
        echo "Dummy Token: " . $dummyToken . "\n";

        $userDummy2 = User::create([
            'name' => 'Dummy user 2', 
            'email' => 'dummy2@gmail.com',
            'nik' => '32612298877',
            'phone' => '0812234234',
            'password' => bcrypt('password')
        ]);

        $dummy2Token = $userDummy2->createToken('Dummy2Token')->plainTextToken;
        echo "Dummy 2 Token: " . $dummy2Token . "\n";
    }
}
