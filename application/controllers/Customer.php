<?php defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends EA_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('customers_model');
    }

    public function send_customer_to_appoiment()
    {   
        $lineUserId = $this->input->post('lineUserId');
        
        if (empty($lineUserId))
        {
            $response = ['warnings' => 'Error line user id is required'];
        }
        else
        {
            $lineUserId_customerData = $this->customers_model->get_data_from_line_id($lineUserId);
            $response = $lineUserId_customerData; 
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));          
        
    }
}