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
    Schema::create('foods', function (Blueprint $table) {
      $table->id();
      $table->enum('food_type', ['canned-goods', 'water', 'grains', 'biscuits', 'others']);
      $table->string('description');
      $table->integer('quantity');
      $table->string('unit')->nullable();
      $table->date('expiry_date')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('foods');
  }
};
