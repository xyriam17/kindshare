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
    Schema::create('expenses', function (Blueprint $table) {
      $table->id();
      $table->double('amount', 10, 2);
      $table->string('description');
      $table->string('reference_no');
      $table->string('status')->default('pending');
      $table->string('fundsource');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('expenses');
  }
};
