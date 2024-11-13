<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    User::create([
      'name' => 'Merriam Mae Salas',
      'firstname' => 'Merriam Mae',
      'middlename' => 'A.',
      'lastname' => 'Salas',
      'email' => 'meriam@gmail.com',
      'email_verified_at' => now(),
      'password' => bcrypt('superadmin'),
    ]);
  }
}
