<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_form extends CUSTOMER_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('payments_model'); 
    $this->load->model('customer_model'); 
    $this->load->model('login_model'); 

  }
  
  public function index() { 
    /* Load page comprising header and form content */
    $this->load->view('templates/header');
    $data = array(
      'title'       => null,
      'first_name'  => null,
      'last_name'   => null,
      'email'       => null,
      'reference'   => null,
      'amount_due'  => null,
      'payment_id'  => null,
      'stripe_id'   => null,
      'customer_id' => null,
      'user_id'     => null
    );        
    $this->load->view('payment_form', $data);
    $this->load->view('templates/footer');
  }	

  /* Load privacy policy */
  public function privacy_policy(){
    $this->load_page('privacy_policy');     
  }  

  /* Called from email */
  public function populate_payment_form(){
    $this->session->set_userdata('user_verified', false);
    $this->load->view('templates/header');
    /* Convert serialized, encoded url segment back to array */
    $data = unserialize(urldecode(base64_decode($this->uri->segment(3))));
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
      $this->load->view('my404.php');        
    }
    $this->load->view('templates/footer'); 
  }

  public function process_payment(){
    $user_id = $this->input->post('user_id');
    $user_row = $this->login_model->get_row('users', 'user_id', $user_id);
    $api_sk = $user_row->api_sk;/* Get secret key from DB based on user */
    require_once APPPATH."libraries/stripe/init.php";/* Include Stripe library */
    \Stripe\Stripe::setApiKey($api_sk);
    $response = array();

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
      $payment_id = $this->input->post('payment_id');
      $stripe_id = $this->input->post('stripe_id');
      $customer_id = $this->input->post('customer_id');
      $this->session->set_userdata('customer_id', $customer_id);
      $this->session->set_userdata('user_id', $user_id);
      $this->session->set_userdata('payment_id', $payment_id);

      /* 
       * Create a Customer
       */
      try{
        /* If customer doesn't already exist */
        if ($stripe_id == NULL){
          $customer = \Stripe\Customer::create(array(
            "email" => $charge_details['email'],
            "source" => $token
          ));
          
          $stripe_id = $customer->id;
          $this->customer_model->update_stripe_id($customer_id, $stripe_id);
        }    

        /* Charge created against customer */
        $charge = \Stripe\Charge::create(array(
          "amount" => $charge_details['amount_due'],
          "currency" => "gbp",
          "customer" => $stripe_id,
          'metadata' => array('Cardholder Name' => $charge_details['cardholder_name'], 'Customer Name' => $charge_details['customer_name'], 'Email' => $charge_details['email']),
          'description' => $charge_details['reference']
//          'receipt_email' => $email - NOT AVAILABLE IN TEST MODE
          /* Alternative available in Payment_status.php */
        ));      

        $this->payments_model->update_payment_status($payment_id);/* Successful charge updates payment status */
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
