<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\RunningBalance;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {


    // Seed the roles table
    Role::insert([
      [
        'name' => 'staff',
        'guard_name' => 'Staff',
      ],
      [
        'name' => 'Admin',
        'guard_name' => 'Admin',
      ],
      [
        'name' => 'Super Admin',
        'guard_name' => 'Super Admin',
      ],
    ]);

    RunningBalance::create([
      'balance_type' => 'collections',
      'previous_balance' => 0,
      'current_balance' => 0,
      'overall_total' => 0,
    ]);
    RunningBalance::create([
      'balance_type' => 'clothing',
      'previous_balance' => 0,
      'current_balance' => 0,
      'overall_total' => 0,
    ]);
    RunningBalance::create([
      'balance_type' => 'money',
      'previous_balance' => 0,
      'current_balance' => 0,
      'overall_total' => 0,
    ]);
    //Seed Default User
    User::create([
      'name' => 'Merriam Mae A. Salas',
      'firstname' => 'Merriam Mae',
      'middlename' => 'A.',
      'lastname' => 'Salas',
      'email' => 'meriam@gmail.com',
      'email_verified_at' => now(),
      'role_id' => 3,
      'password' => bcrypt('superadmin'),
    ]);
  }
}
