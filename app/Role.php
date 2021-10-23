<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    protected $fillable = [
        'name'
    ];
}
