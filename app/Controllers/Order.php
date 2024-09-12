<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;

class Order extends BaseController
{
    public function index()
    {
        echo view('common/header');
        $customerdb = new CustomerModel();
        $productdb = new ProductModel();
        $data['customers'] = $customerdb->findAll();
        $data['products'] = $productdb->findAll();
        echo view('add_order', $data);
    }
    public function view_order()
    {
        echo view('common/header');
        echo view('view_order');
    }
    public function add_order()
    {
        $productdb = new ProductModel();
        $product_id = $this->request->getPost('productId');
        $product = $productdb->where('prod_id', $product_id)->first();
        return $this->response->setJSON($product);
    }
    public function view_all_order()
    {
        $orderdb = new OrderModel();
        $data['order'] = $orderdb->findAll();
        return $this->response->setJSON(['data' => $data]);
    }
}
