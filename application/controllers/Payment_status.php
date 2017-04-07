<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_status extends CUSTOMER_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model'); 
    $this->load->model('login_model');  
    $this->load->model('payments_model'); 
  }
  
  public function index(){
    $user_row = $this->login_model->get_row('users', 'user_id', $this->session->userdata('user_id'));
    $customer_row = $this->customer_model->get_row('customers', 'customer_id', $this->session->userdata('customer_id'));  /* Method in parent model class */  
    $payment_row = $this->payments_model->get_row('payments', 'payment_id', $this->session->userdata('payment_id'));
    $this->load->view('templates/header');
    /* If there is a card error, a code is provided. This can be checked against this array to provide specific details */
    $card_error_codes = array(
      'invalid_number',
      'invalid_expiry_month',
      'invalid_expiry_year',
      'invalid_cvc',
      'invalid_swipe_data',
      'incorrect_number',
      'expired_card',
      'incorrect_cvc',
      'incorrect_zip'
    );
    /* Payment Error Handling */
    $error = $this->session->userdata();
    
    if ($error['success'] == false){
      $error['heading'] = "Unable to process your request";
      /* Card Errors */
      if ($error['type'] == 'card_error'){
        /* Generic Decline */
        if (($error['code'] == 'card_declined') && ($error['decline_code'] != 'fraudulent')){
          $error['partial'] = $this->load->view('templates/generic_decline', '', true);
        }
        /* Decline with fraudulent reason */
        else if (($error['code'] == 'card_declined') && ($error['decline_code'] == 'fraudulent')){
          $error['partial'] = $this->load->view('templates/fraudulent', '', true);
        }
        /* Other possible user related card errors */
        else if (in_array($error['code'], $card_error_codes)){
          $error['partial'] = $this->load->view('templates/generic_decline', '', true);
        }
        /* Any other card errors */
        else{
          $error['partial'] = $this->load->view('templates/other_decline', '', true);
        }
      }
      else if (($error['type'] == 'authentication_error') || ($error['type'] == 'invalid_request_error')){
        log_message('error', 'Payment Error -> Code: '.$error['code'].', Message: '.$error['message']);
        /*
         * Errors that are likely to be system related - eg. Invalid parameters, invalid API key
         */
        $this->load->library('email');
        /* WHen there are multiple users, details will need to be pulled from DB */
        $this -> email
              ->from('james@jkamradcliffe.net', 'VMS Secure Payments')
              ->to($user_row->user_email)
              ->subject('Payment Error')
              ->message("Dear ".$user_row->user_first_name.",\r\n\r\nMessage: ".$error['message']."\r\n\r\nPlease ensure your account details are correct.");    
        $this->email->send();	       
        $error['partial'] = $this->load->view('templates/non_card_error', '', true);
      }
      else{
        /* 
         * For any other error, display a generic message
         * Log the error
         */
        log_message('error', 'Payment Error -> Code: '.$error['code'].', Message: '.$error['message']);
        $error['partial'] = $this->load->view('templates/non_card_error', '', true);
      }
      /* Afford customer opportunity to retry payment */
      $error['retry'] = "Click <a href='".$error['url']."'>HERE</a> or use your browser's back button to try again.";
      $error['exit'] = "To exit without completing your payment, click <a href='https://vmssecurepay.jkamradcliffe.net/index.php/payment_status/non_payment'>HERE</a>.";
      $this->load->view('payment_status', $error);
    }
    else{
      $charge = $this->session->userdata();
      
      $charge['heading'] = "Your payment was successful.";
      $charge['message'] = null;
      $payment_details = array('amount'=>($charge['amount_due']/100), 'email'=>$charge['email'], 'reference'=>$charge['reference'] );
      $charge['partial'] = $this->load->view('templates/payment_successful', $payment_details, true);
      $charge['code'] = null;
      $charge['retry'] = null;
      $charge['exit'] = null;
      $this->load->view('payment_status', $charge);
      
      /* Notification of successful payment for User */
      $this->load->library('email');
      /* WHen there are multiple users, details will need to be pulled from DB */
      $this -> email
            ->from('james@jkamradcliffe.net', 'VMS Secure Payments')
            ->to($user_row->user_email)
            ->subject('Payment Received')
            ->message("Dear ".$user_row->user_first_name.",\r\n\r\nYou've received a payment from ".$customer_row->customer_forename." ".$customer_row->customer_surname."\r\n\r\nReference: ".$payment_row->reference);    
      $this->email->send();	
/* 
 * Preferred method of notifying customer of successful payment will be Stripe email receipt.
 *
 * This needs to be configured when a charge is created in Payment_form controller.
 * This can only be done in live mode
 */

//      $this -> email
//            ->from('james@jkamradcliffe.net', 'VMS')
//            ->to($payment_details['email'])
//            ->subject('Payment Successful')
//            ->message('Dear Fred, You\'re payment has been successful');    
//      $this->email->send();	      
    }

    $this->load->view('templates/footer');
  } 
  
  public function non_payment(){
    $user_row = $this->login_model->get_row('users', 'user_id', $this->session->userdata('user_id'));
    $customer_row = $this->customer_model->get_row('customers', 'customer_id', $this->session->userdata('customer_id'));  /* Method in parent model class */  
    $payment_row = $this->payments_model->get_row('payments', 'payment_id', $this->session->userdata('payment_id'));    
    /* Notification of non-payment for User */
    $this->load->library('email');
    /* WHen there are multiple users, details will need to be pulled from DB */
    $this -> email
          ->from('james@jkamradcliffe.net', 'VMS Secure Payments')
          ->to($user_row->user_email)
          ->subject('Notification of non-payment')
          ->message("Dear ".$user_row->user_first_name.",\r\n\r\nThe following payment has not been completed: \r\n\r\nCustomer ID: ".$customer_row->customer_id."\r\nName: ".$customer_row->customer_forename." ".$customer_row->customer_surname."\r\nEmail: ".$customer_row->email."\r\nPayment Ref: ".$payment_row->reference."\r\n\r\nYou may need to contact this customer to arrange alternative payment." );    
    $this->email->send();	
    header('Location: https://jkamradcliffe.net/vmssecurepay');
  }
}

?>