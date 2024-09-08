<?php

namespace App\Controllers;

class Order extends BaseController
{
    public function index()
    {
        echo view('common/header');
        echo view('add_order');
    }
    public function view_order()
    {
        echo view('common/header');
        echo view('view_order');
    }
}
