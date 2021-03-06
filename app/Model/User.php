<?php

namespace App\Model;

use App\Helper\Model;

class User extends Model
{
    const ASSETS = 'user/';

    protected $table = 'users';
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = ['name', 'alias', 'email', 'password', 'registered_by'];
}
