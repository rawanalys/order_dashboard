<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CustomerModel;

class CustomerApi extends ResourceController
{
    protected $modelName = 'App\Models\CustomerModel';
    protected $format    = 'json';

    // GET /api/customers?page=1&limit=10
    public function index()
    {
        $page = (int) $this->request->getGet('page') ?? 1;
        $limit = (int) $this->request->getGet('limit') ?? 10;
        $offset = ($page - 1) * $limit;

        $customers = $this->model->getCustomers($limit, $offset);
        return $this->respond([
            'page' => $page,
            'limit' => $limit,
            'data' => $customers
        ]);
    }

    // GET /api/customers/{id}
    public function show($id = null)
    {
        if (!is_numeric($id)) {
            return $this->failValidationError('Invalid ID');
        }

        $customer = $this->model->getCustomerWithOrderCount($id);
        if (!$customer) {
            return $this->failNotFound("Customer with ID $id not found.");
        }

        return $this->respond($customer);
    }
}