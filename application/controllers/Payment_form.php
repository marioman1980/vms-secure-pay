<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_form extends CI_Controller {

  public function index() { 
    /* Load page comprising header and form content */
    $this->load->view('templates/header');
    $data = array(
      'title' => null,
      'first_name' => null,
      'last_name' => null,
      'email' => null,
      'reference' => null,
      'amount_due' => null
    );        
    $this->load->view('payment_form', $data);
    $this->load->view('templates/footer');
  }	

  /* Load privacy policy */
  public function privacy_policy(){
    $this->load->view('templates/header');
    $this->load->view('privacy_policy');
    $this->load->view('templates/footer');      
  }  

  /* Called from email */
  public function populate_form(){
    $this->load->view('templates/header');
    /* Convert serialized url segment back to array */
    $data = unserialize(urldecode($this->uri->segment(3)));
    if ($data !== false){
      /* Load payment form, passing details from $data array */
      $this->load->view('payment_form.php', $data);        
    } else {
      /* If url is not valid (likely user has tried to change it manually),
       * load custom(basic) error  view.
       *
       * This will prevent user changing values.
       *
       * CI PHP error can be disabled in index.php by changing environment from development to production
       */
      $this->load->view('custom_url_error.php');        
    }
    $this->load->view('templates/footer'); 
  }

  public function process_payment(){
    require_once APPPATH."libraries/stripe/init.php";/* Include Stripe library */
    \Stripe\Stripe::setApiKey("sk_test_uzOEZerf4OU9Hgg0aWQdpQpG");/* Secret API key */
    $response = array();

    /* Load form helper */ 
    $this->load->helper(array('form'));

    /* Load form validation library */ 
    $this->load->library('form_validation');

    /* Validate/sanitise editable fields */
    $this->form_validation->set_rules('cardholder', 'Cardholder Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));
    
    
    if ($this->form_validation->run() == FALSE) { 
      $response['success'] = false;
      $response['error'] = validation_errors();
    }else{
      /* Get details from form */
      $token = $this->input->post('stripeToken');
      $customer_name = $this->input->post('first_name').' '.$this->input->post('last_name');
      $email = $this->input->post('email');
      $amount_due = $this->input->post('amount_due') * 100;
      $reference = $this->input->post('reference');
      $cardholder_name = $this->input->post('cardholder');

      /* 
       * Create a Customer
       *
       * When database is implemented, it will be possible 
       * to charge the same customer by id
       */
      $customer = \Stripe\Customer::create(array(
        "email" => $this->input->post('email'),
        "source" => $token,
      ));
      
      /* Charge the Customer instead of the card */
      $charge = \Stripe\Charge::create(array(
        "amount" => $amount_due,
        "currency" => "gbp",
        "customer" => $customer->id,
        'metadata' => array('Cardholder Name' => $cardholder_name, 'Customer Name' => $customer_name, 'Email' => $email),
        'description' => $reference
      ));      
      
      $response['success'] = true;
      $response['error'] = null;
    }
    echo json_encode ($response) ;
  }
  
  public function payment_status(){
    
  }

}   
?>
