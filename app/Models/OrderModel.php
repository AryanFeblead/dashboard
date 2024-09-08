<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'customer_product_tbl';
    protected $allowedFields = ['customer_name','prod_name','prod_quantity','prod_price','prod_subtotal'];
    protected $userTimestamps = true;
}