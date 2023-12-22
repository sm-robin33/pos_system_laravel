<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $user = User::create([
      'name' => 'Arena Admin1',
      'phone' => '01911122211',
      'email' => 'admin@arena.com',
      'password' => bcrypt('12345678'),
      'status' => User::$statusArrays[1],
    ]);
    $user1 = User::create([
      'name' => 'Arena Admin2',
      'phone' => '01311111222',
      'email' => 'admin@test.com',
      'password' => bcrypt('12345678'),
      'status' => User::$statusArrays[1],
    ]);
    $user2 = User::create([
      'name' => 'Arena Admin3',
      'phone' => '01941312912',
      'email' => 'admin@biz.com',
      'password' => bcrypt('12345678'),
      'status' => User::$statusArrays[1],
    ]);
    $user->assignRole(1);
    $user1->assignRole(1);
    $user2->assignRole(1);
  }
}
