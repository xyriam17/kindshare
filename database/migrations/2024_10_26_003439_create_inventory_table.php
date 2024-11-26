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
    Schema::create('inventory', function (Blueprint $table) {
      $table->id();
      $table->enum('type', ['food', 'clothing']);
      $table->string('description');
      $table->integer('quantity');
      $table->string('unit')->nullable();
      $table->string('status')->default('onhand');
      $table->date('expiry_date')->nullable(); // Only for food
      $table->string('location');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('inventory');
  }
};
