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
    Schema::table('donations', function (Blueprint $table) {
      $table->foreignId('donor_id')->constrained()->onDelete('cascade');
      $table->enum('type', ['money', 'food', 'clothing']);
      $table->string('food_type')->nullable();
      $table->decimal('amount', 10, 2)->nullable(); // for money donations
      $table->string('reference_no')->nullable(); // for money donations
      $table->string('description')->nullable(); //
      $table->integer('quantity')->nullable(); // for food and clothing donations
      $table->string('unit')->nullable(); // for food and clothing donations
      $table->date('expiry_date')->nullable(); // for food donations
      $table->string('status')->default('pending');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('donations', function (Blueprint $table) {
      //
    });
  }
};
