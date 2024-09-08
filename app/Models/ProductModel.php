<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product_tbl';
    protected $allowedFields = ['prod_name','prod_img','prod_quantity','prod_price','prod_detail'];
    protected $userTimestamps = true;
}