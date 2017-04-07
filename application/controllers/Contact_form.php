<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Contact_form extends CUSTOMER_Controller {

  public function __construct()
  {
    parent::__construct();  
    $this->load->model('login_model');
  }    
  
  public function index(){
    $this->load_page('contact_form');
  }
  
  public function contact_form_submit(){
    /* Sanitise input */
    $this->form_validation->set_rules('first_name', 'First Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));
    $this->form_validation->set_rules('last_name', 'Last Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));   
    $this->form_validation->set_rules('email', 'Email', array('required', 'trim', 'valid_email'));
    
    /* Return form errors in AJAX response */
    if ($this->form_validation->run() == FALSE) { 
      $response['success'] = false;
      $response['error'] = validation_errors();
    }else{    
      $config = array(
        'charset' => 'utf-8'
      );           
	    /* Load CI email library */
	    $this->load->library('email');
      $this->email->initialize($config);
      
//      $user_id = $this->session->userdata('user_id');
//      $user_row = $this->login_model->get_row('users', 'user_id', $user_id);/* Get user row so details can be used in email */      

      /* prepare email */
      $this -> email
            ->from($this->input->post('email'), $this->input->post('first_name').' '.$this->input->post('last_name'))
            ->to('j.kamradcliffe1980@gmail.com')

            ->subject('Contact Form')
            ->message('Name: '.$this->input->post('first_name').' '.$this->input->post('last_name').
                      "\r\n".'Email: '.$this->input->post('email').
                      "\r\n\r\n".'Message: '.$this->input->post('message'));

      /* Send email */
      $this->email->send();	
      
      /* Add messages to response */
      $response['success'] = true;
      $response['error'] = null;  
    }
    /* Return response to AJAX in header.php */
    echo json_encode ($response) ;    
    
    
  }
  
  /* Form sent successfully */
  public function contact_success(){
    $this->load->view('templates/header');
    $this->load->view('contact_success');
    $this->load->view('templates/footer');    
  }
}

?>