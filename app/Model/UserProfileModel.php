<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserProfileModel extends Model
{
    protected $table = 'user_profile';
    protected $fillable = array(
        'id', 'education', 'location', 'skills', 'notes'
    );
}
