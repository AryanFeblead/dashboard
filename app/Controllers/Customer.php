<?php

namespace App\Controllers;

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
}
