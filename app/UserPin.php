<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPin extends Model
{
    protected $fillable = [
        'email', 'pin'
    ];
}
