<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use CodeIgniter\API\ResponseTrait;

class Orders extends BaseController
{
    use ResponseTrait;

    public function getOrdersByCustomer($id = null)
    {
        if (!$id || !is_numeric($id)) {
            return $this->failValidationError('A valid customer ID must be provided.');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $user = $builder->where('id', $id)->get()->getRow();

        if (!$user) {
            return $this->failNotFound('Customer not found.');
        }

        $model = new OrderModel();
        $orders = $model->where('user_id', $id)->findAll();

        if (empty($orders)) {
            return $this->respond([
                'status' => true,
                'message' => 'No orders found for this customer.',
                'data' => []
            ]);
        }

        return $this->respond([
            'status' => true,
            'data' => $orders
        ]);
    }
}