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
      'email' => 'meriam@gmail.com',
      'password' => bcrypt('superadmin'),
    ]);
  }
}
