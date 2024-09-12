<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CustomerModel;

class Report extends BaseController
{
    public function index()
    {
        echo view('common/header');
        $customerdb = new CustomerModel();
        $data['customers'] = $customerdb->findAll();
        echo view('report', $data);
    }
    public function view_report()
    {
        $orderdb = new OrderModel();
        $data = $orderdb->findAll();
        return $this->response->setJSON($data);
    }
}
