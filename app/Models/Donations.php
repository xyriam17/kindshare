<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
  use HasFactory;

  protected $fillable = ['amount', 'status'];


  public function donors()
  {
    return $this->belongsTo(Donors::class);
  }
}
