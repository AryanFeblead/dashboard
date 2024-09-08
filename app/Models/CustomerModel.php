<?php 

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer_tbl';
    protected $allowedFields = ['customer_name','customer_email','customer_phone','customer_gender','customer_address'];
    protected $userTimestamps = true;
}