<?php

/**
 * JSON API
 */
class Json extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        // CORE
        $this->admin_model = $this->loadModel('Admin');
        $this->branch_model = $this->loadModel('Branch');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        $this->inventory_model = $this->loadModel('Inventory');
        $this->category_model = $this->loadModel('Category');
        Auth::loginCheck();
    }

    function data($type)
    {
        switch($type){
            case 'products':
                echo $this->product_model->getData();
                break;
        }
    }

    public function reports($type) {
        switch ($type) {
            case 'sales':
                return $this->sales_model->getAllSales('json');
                break;
            case 'inventory':
                return $this->inventory_model->reportProducts('json');
                break;
        }
    }

    public function get_products($type = NULL)
    {
        switch ($type) {
            default:
                return $this->product_model->getAllProducts('json');
                break;
        }
    }

    public function audit_logs($type = false)
    {
        Auth::loginCheck();
        return $this->audit_model->get_logs('json');
    }

    public function test()
    {
        $data = $this->sales_model->getAllSales();

        echo $data[0]->time;

        echo '<pre>';
        print_r($data);
    }
    
}
