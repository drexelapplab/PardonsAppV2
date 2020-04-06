<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $applicant = Role::create([
            'name' => 'Applicant', 
            'slug' => 'applicant',
            'permissions' => [
                'create-app' => true,
                'view-app' => true,
                'edit-app' => true,
            ]
        ]);
        $admin = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'view-all-apps' => true,
            ]
        ]);
    }
}
