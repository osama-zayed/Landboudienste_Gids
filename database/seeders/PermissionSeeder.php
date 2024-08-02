<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'فتح مؤاسسة']);
        Permission::create(['name' => 'ترخيص']);

        $user = Role::create(['name' => 'مستخدم']);

        $user->givePermissionTo('فتح مؤاسسة');
        $user->givePermissionTo('ترخيص');
    }
}
