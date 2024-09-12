<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customer extends BaseController
{
    public function index()
    {
        echo view('common/header');
        echo view('add_customer');
    }
    public function view_customer()
    {
        echo view('common/header');
        echo view('view_customer');
    }
    public function checkCustomerExists($email, $phone) {
        // $customerdb = new CustomerModel();
        // $customerdb->where('customer_email', $email)->or_where('customer_phone', $phone);
        // $query = $customerdb->get('customer_tbl');
        // print_r('asdasd');die;
        // return $query->row_array();
    }    
    public function add_customer() {

        $customer_name = $this->request->getPost('customer_name');
        $customer_email = $this->request->getPost('customer_email');
        $customer_phone = $this->request->getPost('customer_phone');
        $customer_gender = $this->request->getPost('customer_gender');
        $customer_address = $this->request->getPost('customer_address');
    
        $customer_name = htmlspecialchars(trim($customer_name));
        $customer_email = filter_var(trim($customer_email), FILTER_VALIDATE_EMAIL);
        $customer_phone = filter_var(trim($customer_phone), FILTER_SANITIZE_NUMBER_INT);
        $customer_address = htmlspecialchars(trim($customer_address));

        $customerdb = new CustomerModel();
        // $existingCustomer = $this->checkCustomerExists($customer_email, $customer_phone);
        // print_r($customer_phone);die;

        // if ($existingCustomer) {
        //     if ($existingCustomer['customer_email'] === $customer_email) {
        //         echo json_encode(["status" => "error", "message" => "Email already exists"]);
        //     } elseif ($existingCustomer['customer_phone'] === $customer_phone) {
        //         echo json_encode(["status" => "error", "message" => "Phone number already exists"]);
        //     }
        //     return;
        // }
    
        if ($customer_name && $customer_email && $customer_phone && $customer_gender && $customer_address) {
            $data = array(
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_phone' => $customer_phone,
                'customer_gender' => $customer_gender,
                'customer_address' => $customer_address
            );
            // print_r($data);
            if ($customerdb->insert($data)) {
                echo json_encode(["status" => "success", "message" => "Customer added successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to add customer"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid input data"]);
        }
    }
    
    public function view_all_customer()
    {
        $customerdb = new CustomerModel();
        $data['customer'] = $customerdb->findAll();
        return $this->response->setJSON(['data' => $data]);
    }
}