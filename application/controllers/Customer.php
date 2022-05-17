<?php defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends EA_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('line_message');
        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');
        $this->load->library('timezones');
    }

    public function send_customerData_to_appoiment()
    {   
        $lineUserId = 'U6260f39e480af845875270a10dfcc9e7';
        $lineUserId_customerData = $this->customers_model->get_have_lineUserId_row($lineUserId);

        print_r($lineUserId_customerData);
    }
}