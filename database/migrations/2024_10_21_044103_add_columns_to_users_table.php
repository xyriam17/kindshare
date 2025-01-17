<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('firstname')->nullable();
      $table->string('middlename')->nullable();
      $table->string('lastname')->nullable();
      $table->string('address')->nullable();
      $table->string('contact_number')->nullable();
      $table->integer('role_id');
      $table->string('profile_photo_path')->nullable(); // profile photo
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table) {
      //
    });
  }
};
