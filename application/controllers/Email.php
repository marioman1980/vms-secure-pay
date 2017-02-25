<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Email extends CI_Controller {

   
  public function htmlmail(){
    
    $errors = array();
    $response = array();
    $success = array();
    $success['success'] = null;	    
      
    /* Load form helper */ 
    $this->load->helper(array('form'));

    /* Load form validation library */ 
    $this->load->library('form_validation');		 
    /* Custom error messages */
    $this->form_validation->set_message('regex_match', 'The {field} field can only contain letters and white space');
    $this->form_validation->set_message('required', '{field} required');
    $this->form_validation->set_message('valid_email', 'Please enter a valid email address');
    
    /* Validate and sanitize input */
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('first_name', 'First Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));
    $this->form_validation->set_rules('last_name', 'Last Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));   
    $this->form_validation->set_rules('email', 'Email', array('required', 'trim', 'valid_email'));
    $this->form_validation->set_rules('agent', 'Agent', array('required', 'trim', 'htmlspecialchars'));
    $this->form_validation->set_rules('reference', 'Reference', array('required', 'trim', 'htmlspecialchars'));
    $this->form_validation->set_rules('resort', 'Resort', array('required', 'trim', 'htmlspecialchars'));
    $this->form_validation->set_rules('amount_due', 'Amount Due', 'numeric');

    
    /* If there are errors, add messages to response */
    if ($this->form_validation->run() == FALSE) { 
      $response['success'] = "There are errors in the form";
      $response['error'] = validation_errors();
    } 
    /* If there are no errors, compile and send email */
    else { 
      /* Details from User form */
      $data = array(
        'title'      => $this->input->post('title'),
        'first_name' => $this->input->post('first_name'),
        'last_name'  => $this->input->post('last_name'),
        'email'      => $this->input->post('email'),
        'reference'  => $this->input->post('reference'),
        'amount_due' => $this->input->post('amount_due')
      );		 			 			 
        
      /* Prepare array for url */
      $data = urlencode(serialize($data));
      
      /* Create url. 
       * populate_form will be function called from payment_form page.
       * Encoded $data array passed as parameter to populate_form.
       * Unlike using query string, it will not be possible to edit url without causing error
       */
      $url = 'https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/populate_form/'.$data;
      
      /* Convert $data back to array and append url */
      $data = unserialize(urldecode($data));
      $data['agent'] = $this->input->post('agent');
      $data['resort'] = $this->input->post('resort');
      $data['message'] = $this->input->post('message');
      $data['url'] = $url;
      
      /* Charset and other preferences */
      $config = array(
        'charset' => 'utf-8'
      );         
     
	    /* Load CI email library */
	    $this->load->library('email');
      $this->email->initialize($config);

      /* prepare email */
      $this -> email
            ->from('james@jkamradcliffe.net', 'VMS')
            ->to($data['email'])
//            ->cc('james@jkamradcliffe.net')/* Comment out for testing */
            ->subject('Your Payment Details - VMS')
        /* Body of email includes values extracted from form stored in $data */
            ->message($this->load->view('email.php', $data, true))
            ->set_mailtype('html');


      /* Send email */
      $this->email->send();	
      
      /* Add messages to response */
      $response['success'] = "Email Sent!!";
      $response['error'] = null;

    }
    /* Return response to AJAX in header.php */
    echo json_encode ($response) ;
    
  }     
}

?>