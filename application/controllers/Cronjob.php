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
        $appointments = $this->appointments_model->get_scheduled_appointments($day_start, $day_end);

        if(count($appointments) > 0){
            $settings = [
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_address' => $this->settings_model->get_setting('company_address'),
            ];
            foreach ($appointment as $appointments) {
                $provider = $this->providers_model->get_row($appointment['id_users_provider']);
                $service = $this->services_model->get_row($appointment['id_services']);
                $customer = $this->customers_model->get_row($appointment['id_users_customer']);
                line_message_cronjob($setting, $provider, $service, $customer, $appointment);
            }
        }

        print_r($appointments);
        // echo json_encode($datetime);
    }
}