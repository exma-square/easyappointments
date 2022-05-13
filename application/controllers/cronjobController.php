<?php defined('BASEPATH') or exit('No direct script access allowed');

class cronjobController extends EA_Controller {

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

    public function send_notify_to_appoiment()
    {
        $today = strtotime(date("Y-m-d")); 
        $start_datetime = $this->appointments_model->get_value('start_datetime', $appointment['id']);
        
        $remind_time = $this->settings_model->get_setting('remind_time');

        $result = floor((strtotime($start_datetime) - $today) / 3600 / 24);

        if($result == $remind_time)
        {
            line_message_change($settings, $customer, $service, $appointment);
        }
        
    }
}