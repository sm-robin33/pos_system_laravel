<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $superAdmin = Role::create([
      'name' => 'Super Admin'
    ]);
    $admin = Role::create([
      'name' => 'Admin'
    ]);
    $superAdmin->givePermissionTo(Permission::all());
  }
}
