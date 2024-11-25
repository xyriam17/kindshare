<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RunningBalance extends Model
{
  use HasFactory;

  protected $table = 'running_balance';
  protected $fillable = ['previous_balance', 'current_balance'];
}
