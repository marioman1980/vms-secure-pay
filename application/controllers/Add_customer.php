<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

  class Add_customer extends USER_Controller {
      
    public function __construct()
    {
      parent::__construct();
      /* Load model */
      $this->load->model('customer_model');  
          
    }      
                
    public function index(){ 
        /* Default form values */
        $data['customer'] = (object)[
          'customer_id'       => null,
          'title'             => 'Select',
          'customer_forename' => null,
          'customer_surname'  => null,
          'email'             => null
        ];        
        
        $this->load->view('templates/header');
        $this->load->view('add_customer', $data);
        $this->load->view('templates/footer');       
    }
    
    public function add_new_customer(){
      /* Sanitize input */
      $this->form_validation->set_rules('customer_forename', 'First Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));
      $this->form_validation->set_rules('customer_surname', 'Last Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));   
      $this->form_validation->set_rules('email', 'Email', array('required', 'trim', 'valid_email'));  
      
      /* If there are errors, add messages to AJAX response */
      if ($this->form_validation->run() == FALSE) { 
        $response['success'] = false;
        $response['error'] = validation_errors();
      }else{      
        $response['success'] = true;
        /* Add new record via model */
        $this->customer_model->register_customer();  
      }
      echo json_encode ($response);  
    }
    
    public function edit_customer(){
      $customer_id = $this->input->post('btn-edit-details');/* Get ID from currently selected row */
      $this->populate_form('customer', 'customer_model', 'customers', 'customer_id', $customer_id, 'add_customer');     
    }    
  }
    
?>