<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'first_name', 'last_name', 'email', 'age', 'gender', 'state', 'street_address',
        'postal_code', 'city', 'country', 'latitude', 'longitude', 'traffic_source', 'created_at'
    ];

    public function getCustomers($limit = 10, $offset = 0)
    {
        return $this->select('users.*, COUNT(orders.order_id) as order_count')
                    ->join('orders', 'orders.user_id = users.id', 'left')
                    ->groupBy('users.id')
                    ->limit($limit, $offset)
                    ->findAll();
    }

    public function getCustomerWithOrderCount($id)
    {
        return $this->select('users.*, COUNT(orders.order_id) as order_count')
                    ->join('orders', 'orders.user_id = users.id', 'left')
                    ->where('users.id', $id)
                    ->groupBy('users.id')
                    ->first();
    }
}