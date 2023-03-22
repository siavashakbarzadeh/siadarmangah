<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'add-member']);
        Permission::create(['name'=>'delete-member']);
        Permission::create(['name'=>'edit-member']);

        Permission::create(['name'=>'add-user']);
        Permission::create(['name'=>'delete-user']);

        Permission::create(['name'=>'add-course']);
        Permission::create(['name'=>'delete-course']);
        Permission::create(['name'=>'edit-course']);

        Permission::create(['name'=>'add-payment']);
        Permission::create(['name'=>'delete-payment']);

        Permission::create(['name'=>'add-company']);
        Permission::create(['name'=>'delete-company']);

        Permission::create(['name'=>'send-quota']);
        Permission::create(['name'=>'open-year']);

        Permission::create(['name'=>'app-settings']);

        Permission::create(['name'=>'email-settings']);

        $superAdminRole = Role::create(['name'=>'Super Admin']);
        $adminRole = Role::create(['name'=>'Admin']);
        $accountantRole = Role::create(['name'=>'Accountant']);
        $editorRole = Role::create(['name'=>'Editor']);

        $superAdminRole->givePermissionTo([
            'add-member',
            'delete-member',
            'edit-member',
            'add-user',
            'delete-user',
            'add-course',
            'delete-course',
            'edit-course',
            'add-payment',
            'delete-payment',
            'send-quota',
            'open-year',
            'app-settings',
            'email-settings',
            'add-company',
            'delete-company'
        ]);

        $adminRole->givePermissionTo([
            'add-member',
            'delete-member',
            'edit-member',
            'add-user',
            'delete-user',
            'add-course',
            'delete-course',
            'edit-course',
            'add-payment',
            'delete-payment',
            'send-quota',
            'open-year',
            'app-settings',
            'add-company',
            'delete-company'
        ]);

        $accountantRole->givePermissionTo([
            'add-member',
            'delete-member',
            'edit-member',
            'add-user',
            'delete-user',
            'add-course',
            'delete-course',
            'edit-course',
            'add-payment',
            'delete-payment',
            'add-company',
            'delete-company'
        ]);

        $editorRole->givePermissionTo([
            'add-member',
            'delete-member',
            'edit-member',
            'add-user',
            'delete-user',
            'add-course',
            'delete-course',
            'edit-course',
            'add-company',
            'delete-company',
            'add-company',
            'delete-company'
        ]);

    }
}
