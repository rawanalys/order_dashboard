<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $allowedFields = [
        'order_id', 'user_id', 'status', 'gender',
        'created_at', 'returned_at', 'shipped_at', 'delivered_at', 'num_of_item'
    ];
    public $useTimestamps = false;
}