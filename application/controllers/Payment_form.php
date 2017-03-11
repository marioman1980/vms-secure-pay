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

    /* Initialise session */
    $this->load->library('session');
    
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
      $response['success'] = true;
      /* Get details from form */
      $charge_details = array(
        'customer_name'   => $this->input->post('first_name').' '.$this->input->post('last_name'),
        'email'           => $this->input->post('email'),
        'amount_due'      => $this->input->post('amount_due') * 100,
        'reference'       => $this->input->post('reference'),
        'cardholder_name' => $this->input->post('cardholder')
      );
      $token = $this->input->post('stripeToken');
//      $customer_name = $this->input->post('first_name').' '.$this->input->post('last_name');
//      $email = $this->input->post('email');
//      $amount_due = $this->input->post('amount_due') * 100;
//      $reference = $this->input->post('reference');
//      $cardholder_name = $this->input->post('cardholder');

      /* 
       * Create a Customer
       *
       * When database is implemented, it will be possible 
       * to charge the same customer by id
       */
      try{
        $customer = \Stripe\Customer::create(array(
          "email" => $charge_details['email'],
          "source" => $token
        ));

        /* Charge the Customer instead of the card */
        $charge = \Stripe\Charge::create(array(
          "amount" => $charge_details['amount_due'],
          "currency" => "gbp",
          "customer" => $customer->id,
          'metadata' => array('Cardholder Name' => $charge_details['cardholder_name'], 'Customer Name' => $charge_details['customer_name'], 'Email' => $charge_details['email']),
          'description' => $charge_details['reference']
//          'receipt_email' => $email - NOT AVAILABLE IN TEST MODE
        ));      

        $this->session->set_userdata($charge_details);
        $this->session->set_userdata('success', true);
        $response['error'] = null;        
      }
      /*
       * Catch card/API/system errors
       *
       * Payment_status controller will discern specific card errors
       *
       */
      catch(\Stripe\Error\Base $e){
        
        $e_json = $e->getJsonBody();
        $error = $e_json['error'];
        $response['error'] = null;
        $this->session->set_userdata($error);
        $this->session->set_userdata('success', false);
        $this->session->set_userdata('url', $this->input->post('url'));
      }	
    }
    echo json_encode ($response) ;
  }
  

}   
?>
