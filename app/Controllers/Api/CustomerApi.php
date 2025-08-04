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
        $page = (int) $this->request->getGet('page');
        $limit = (int) $this->request->getGet('limit');

        // Handle missing or invalid pagination params
        if ($page < 1) {
            $page = 1;
        }

        if ($limit < 1 || $limit > 100) {
            $limit = 10; // Default to 10 with a max cap of 100
        }

        $offset = ($page - 1) * $limit;

        try {
            $customers = $this->model->getCustomers($limit, $offset);

            return $this->respond([
                'status' => true,
                'page' => $page,
                'limit' => $limit,
                'data' => $customers
            ]);
        } catch (\Throwable $e) {
            return $this->failServerError("Error fetching customers: " . $e->getMessage());
        }
    }

    // GET /api/customers/{id}
    public function show($id = null)
    {
        if (!$id || !is_numeric($id)) {
            return $this->failValidationError('A valid numeric ID must be provided.');
        }

        try {
            $customer = $this->model->getCustomerWithOrderCount($id);
            if (!$customer) {
                return $this->failNotFound("Customer with ID $id not found.");
            }

            return $this->respond([
                'status' => true,
                'data' => $customer
            ]);
        } catch (\Throwable $e) {
            return $this->failServerError("Error fetching customer: " . $e->getMessage());
        }
    }
}