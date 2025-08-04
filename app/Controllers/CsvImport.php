<?php

namespace App\Controllers;

ini_set('memory_limit', '-1');

use App\Models\UserModel;
use App\Models\OrderModel;
use CodeIgniter\Controller;

class CsvImport extends BaseController
{
        public function importUsers()
    {
        $file = fopen(ROOTPATH . 'public/uploads/users.csv', 'r');
        fgetcsv($file); // Skip header

        $userModel = new UserModel();
        $db = \Config\Database::connect();

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) < 15) continue;

            $existingUser = $db->table('users')->where('id', $row[0])->get()->getRow();

            if ($existingUser) {
                continue; // Skip if user already exists
            }

            $userModel->insert([
                'id'             => $row[0],
                'first_name'     => $row[1],
                'last_name'      => $row[2],
                'email'          => $row[3],
                'age'            => $row[4],
                'gender'         => $row[5],
                'state'          => $row[6],
                'street_address' => $row[7],
                'postal_code'    => $row[8],
                'city'           => $row[9],
                'country'        => $row[10],
                'latitude'       => $row[11],
                'longitude'      => $row[12],
                'traffic_source' => $row[13],
                'created_at'     => $row[14]
            ]);
        }

        fclose($file);
        return "Users imported successfully (duplicates skipped).";
    }

    public function importOrders()
    {
        $file = fopen(ROOTPATH . 'public/uploads/orders.csv', 'r');
        fgetcsv($file); // Skip header

        $model = new OrderModel();
        $db = \Config\Database::connect();

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) < 9) continue;

            $orderId = $row[0];
            $userId = $row[1];

            // Skip if user doesn't exist
            $userExists = $db->table('users')->where('id', $userId)->get()->getRow();
            if (!$userExists) {
                continue;
            }

            // Skip if order already exists
            $orderExists = $db->table('orders')->where('order_id', $orderId)->get()->getRow();
            if ($orderExists) {
                continue;
            }

            $model->insert([
                'order_id'     => $orderId,
                'user_id'      => $userId,
                'status'       => $row[2],
                'gender'       => $row[3],
                'created_at'   => $row[4],
                'returned_at'  => $row[5] ?: null,
                'shipped_at'   => $row[6],
                'delivered_at' => $row[7],
                'num_of_item'  => $row[8],
            ]);
        }

        fclose($file);
        return "Orders imported successfully (duplicates and missing user_ids skipped).";
    }
}