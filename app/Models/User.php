<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'last_name', 'first_name', 'address', 'country', 
        'email', 'phone_number', 'password', 'profile_picture'
    ];
}
