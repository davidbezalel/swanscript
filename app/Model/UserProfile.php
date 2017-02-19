<?php

namespace App\Model;

use App\Helper\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    protected $fillable = array(
        'id', 'education', 'location', 'skills', 'notes'
    );
}
