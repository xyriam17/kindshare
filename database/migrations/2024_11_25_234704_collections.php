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
    Schema::create('tithes_collections', function (Blueprint $table) {
      $table->id();
      $table->double('amount', 10, 2);
      $table->string('source');
      $table->string('reference_no');
      $table->string('description')->nullable();
      $table->string('status')->default('collected');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tithes_collections');
  }
};
