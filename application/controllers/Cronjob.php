<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends EA_Controller {

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
        $remind_time = $this->settings_model->get_setting('remind_time');
        $day_start = $remind_time;
        $day_end = $remind_time +1;
        echo $day_start;
        echo $day_end;
        $datetime = $this->appointments_model->get_datetime($day_start, $day_end);
        print_r($datetime);
        // echo json_encode($datetime);
    }
}