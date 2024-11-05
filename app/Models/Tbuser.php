<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tbuser extends Authenticatable
{
    use HasFactory;

   protected $table = 'tbusers';

   protected $primaryKey = 'UserID';

    protected $fillable = [
      'UserID',
      'NamaUser',
      'username',
      'password',
    ];
}
