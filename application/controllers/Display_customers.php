<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

  class Display_customers extends USER_Controller {
    
    public function __construct()
    {
      parent::__construct();
      /* Load model */
      $this->load->model('customer_model'); 
    }
    
    public function index(){
        /* Get customers to populate table via model */
        $data['customers'] = $this->customer_model->show_all_customers();
        $this->load->view('templates/header');
        $this->load->view('display_customers', $data);
        $this->load->view('templates/footer');         
    }
    
    public function delete_customer(){
      $customer_id = $this->input->post('hidden_delete');
      $this->customer_model->delete_customer($customer_id);
//      header('Location: '.site_url('display_customers'));
    }    
  
  }

?>