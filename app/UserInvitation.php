<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    protected $fillable = [
        'email', 'token'
    ];
}
