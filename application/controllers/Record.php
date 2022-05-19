<?php defined('BASEPATH') or exit('No direct script access allowed');

class Record extends EA_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');
    }

    public function get_appointments_from_line_id()
    {   
        $lineUserId = $this->input->post('lineUserId');

        if (empty($lineUserId))
        {
            $response = ['warnings' => 'Error line user id is required'];
        }
        else
        {
            $customer_id = $this->customers_model->get_value_from_line_id('id', $lineUserId);
            $appointments = $this->appointments_model->get_appointments_from_customer($customer_id);

            foreach($appointments as $id_services => $appointments)
            {
                $service = $this->services_model->get_row($appointments['id_services']);
                $appointments['id_services'] = $service['name'];
                $response[] = $appointments;
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));  
    }
}