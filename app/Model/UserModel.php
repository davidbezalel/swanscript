<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = ['name', 'alias', 'email', 'password', 'registered_by'];
}
