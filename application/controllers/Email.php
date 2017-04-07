<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Email extends USER_Controller {
  
  public function __construct()
  {
    parent::__construct();
    /* Load model */
    $this->load->model('payments_model');  
    $this->load->model('customer_model'); 
    $this->load->model('login_model');  
  }  
  
/* Custom validation */  
  public function not_zero($amount){
    if ($amount == 0.00){
      $this->form_validation->set_message('not_zero', 'The {field} field cannot be 0.00');
      return false;
    }
    else{
      return true;
    }
  }  
  
  public function htmlmail(){
    
    $errors = array();
    $response = array();
    $success = array();
    $success['success'] = null;	    
      
    /* Load form helper */ 
    $this->load->helper(array('form'));

    /* Load form validation library */ 
    $this->load->library('form_validation');		 
    
    /* Validate and sanitize input */
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('customer_forename', 'First Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));
    $this->form_validation->set_rules('customer_surname', 'Last Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));   
    $this->form_validation->set_rules('email', 'Email', array('required', 'trim', 'valid_email'));
    $this->form_validation->set_rules('payment_for', 'Payment For', array('required', 'trim', 'htmlspecialchars'));
    $this->form_validation->set_rules('reference', 'Reference', array('required', 'trim', 'htmlspecialchars'));
    $this->form_validation->set_rules('miscellaneous', 'Miscellaneous', array('trim', 'htmlspecialchars'));
    $this->form_validation->set_rules('amount_due', 'Amount Due', array('numeric', 'callback_not_zero'));
        
    /* If there are errors, add messages to response */
    if ($this->form_validation->run() == FALSE) { 
      $response['success'] = false;
      $response['error'] = validation_errors();
    } 
    /* If there are no errors, compile and send email */
    else { 
      $user_id = $this->session->userdata('user_id');
      $user_row = $this->login_model->get_row('users', 'user_id', $user_id);/* Get user row so details can be used in email */
      $customer_id = $this->session->userdata('customer_id');
      if ($customer_id == null){
        $customer_id = $this->customer_model->register_customer();  /* If new, create customer record and get id */   
      }
      $payment_id = $this->payments_model->create_payment($customer_id);

      /* Stripe ID used to attribute payments to existing Stripe customers
       * If there is no Stripe ID, a new Stripe customer is created in Stripe */
      $stripe_id = $this->customer_model->get_row('customers', 'customer_id', $customer_id)->stripe_id;
      
      /* Details from User form */
      $data = array(
        'title'       => $this->input->post('title'),
        'first_name'  => $this->input->post('customer_forename'),
        'last_name'   => $this->input->post('customer_surname'),
        'email'       => $this->input->post('email'),
        'reference'   => $this->input->post('reference'),
        'amount_due'  => $this->input->post('amount_due'),
        'payment_id'  => $payment_id,
        'customer_id' => $customer_id,
        'stripe_id'   => $stripe_id,
        'user_id'     => $user_id,
        'api_pk'      => $user_row->api_pk,
        'img'         => $user_row->logo_url,
        'username'    => $user_row->user_first_name.' '.$user_row->user_last_name,
        'company'     => $user_row->company_name
      );		 			 			 
        
      /* 
       * Prepare array for url
       * Base64 obfuscates the produced string, preventing it from being altered client-side
       */
      $data = base64_encode(urlencode(serialize($data)));

      /* Create url. 
       * populate_form will be function called from payment_form page.
       * Encoded $data array passed as parameter to populate_form.
       * Unlike using query string, it will not be possible to edit url without causing error
       */
      $url = 'https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/populate_payment_form/'.$data;
      /* Convert $data back to array and append url */
      $data = unserialize(urldecode(base64_decode($data)));

      $data['payment_for'] = $this->input->post('payment_for');
      $data['miscellaneous'] = $this->input->post('miscellaneous');
      $data['message'] = $this->input->post('message');
      $data['url'] = $url;

      $config = array(
        'charset' => 'utf-8'
      );         
     
	    /* Load CI email library */
	    $this->load->library('email');
      $this->email->initialize($config);

      
      /* prepare email */
      $this -> email
            ->from('james@jkamradcliffe.net', $user_row->company_name)
            ->to($data['email'])
            ->reply_to($user_row->user_email, $user_row->company_name)
//            ->cc($user_row->user_email)/* Comment out for testing */
            ->subject($user_row->company_name.' - Payment Details')
        /* Body of email includes values extracted from form stored in $data */
            ->message($this->load->view('email.php', $data, true))
            ->set_mailtype('html');

      /* Send email */
      $this->email->send();	
      
      /* Add messages to response */
      $response['success'] = true;
      $response['error'] = null;

    }
    /* Return response to AJAX */
    echo json_encode ($response) ;
    
  }     
}

?>