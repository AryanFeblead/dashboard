<?php

namespace App\Controllers;
use App\Models\ProductModel;

class Product extends BaseController
{
    public function index()
    {
        echo view('common/header');
        echo view('add_product');
    }
    public function view_product()
    {
        echo view('common/header');
        echo view('view_product');
    }
    public function add_product() {
        $fileNames = array();

        $filepath = FCPATH . 'uploads/';
        if (!is_dir($filepath)) {
            if (!mkdir($filepath, 0755, true)) {
                die('Failed to create upload directory...');
            }
        }
        
        if (!empty($_FILES['prod_img']['name'][0])) {
            foreach ($_FILES['prod_img']['name'] as $key => $val) {
                $_FILES['file'] = [
                    'name'     => $_FILES['prod_img']['name'][$key],
                    'type'     => $_FILES['prod_img']['type'][$key],
                    'tmp_name' => $_FILES['prod_img']['tmp_name'][$key],
                    'error'    => $_FILES['prod_img']['error'][$key],
                    'size'     => $_FILES['prod_img']['size'][$key]
                ];
                
                if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $targetFilePath = $filepath . basename($_FILES['file']['name']);
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                        $fileNames[] = $_FILES['file']['name'];
                    } else {
                        echo "Failed to upload file " . htmlspecialchars($_FILES['file']['name']) . ".<br>";
                    }
                } else {
                    echo "Error uploading file " . htmlspecialchars($_FILES['file']['name']) . ". Error code: " . $_FILES['file']['error'] . "<br>";
                }
            }
            $fileNamesString = implode(',', $fileNames);
        } else {
            echo "No files were uploaded.";
        }
        
        
        $prod_name = $this->request->getPost('prod_name');
        $prod_qun = $this->request->getPost('prod_qun');
        $prod_price = $this->request->getPost('prod_price');
        $prod_detail = $this->request->getPost('prod_detail');
        
        $data = array(
            'prod_name' => $prod_name,
            'prod_img' => $fileNamesString,
            'prod_quantity' => $prod_qun,
            'prod_price' => $prod_price,
            'prod_detail' => $prod_detail
        );
        $productdb = new ProductModel();

        if ($productdb->insert($data)) {
            echo json_encode(["status" => "success", "message" => "Product added successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to add product"]);
        }
    }
    
    public function view_all_product()
    {
        $productdb = new ProductModel();
        $data['product'] = $productdb->findAll();
        return $this->response->setJSON(['data' => $data]);
    }
}
