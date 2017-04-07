<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class Main extends USER_Controller {
      
    public function __construct()
    {
      parent::__construct(); 
      
      $this->load->library('session');
      $this->load->model('customer_model');  
      
    }      
      
		public function index() {       
        /* Open blank payment request form */
        $this->session->set_userdata('customer_id', null);
        $data['customer'] = (object)[
          'title' => 'Select',
          'customer_forename' => null,
          'customer_surname' => null,
          'email' => null
        ];
         /* Load page comprising header and main content */
        $this->load->view('templates/header');
        $this->load->view('main', $data);
        $this->load->view('templates/footer');       
		}	 
      
    public function populate_from_db(){
      /* Populate payment request form from DB */
      $customer_id = $this->input->post('btn-request-payment');   
      $this->session->set_userdata('customer_id', $customer_id);
      $this->populate_form('customer', 'customer_model', 'customers', 'customer_id', $customer_id, 'main');     
    }
      
  }   
?>