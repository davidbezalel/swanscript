<?php

namespace App\Model;

use App\Helper\Model;

class UserRole extends Model
{
    protected $table = 'role';
    protected $fillable = array(
        'id', 'name', 'description'
    );
}
