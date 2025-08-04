<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'first_name', 'last_name', 'email', 'age', 'gender',
        'state', 'street_address', 'postal_code', 'city', 'country',
        'latitude', 'longitude', 'traffic_source', 'created_at'
    ];
    public $useTimestamps = false;
}