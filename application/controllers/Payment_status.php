<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_status extends CI_Controller {
  
  public function index(){
    $this->load->library('session');
    $this->load->view('templates/header');
    
    /* Custom helper to handle errors during payment */
//    $this->load->helper('payment_error_helper');
//    
//    $error['foo'] = $this->payment_errors->handle_error();
//    $this->load->view('payment_status', $error);
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
    
    $error = $this->session->userdata();
    
    if ($error['success'] == false){
      $error['heading'] = "Unable to process your request";
      /* Card Errors */
      if ($error['type'] == 'card_error'){
        log_message('error', 'There\'s a card error.');//DO SOMETHING SENSIBLE WITH THIS
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
        /*
         * Errors that are likely to be system related - eg. Invalid parameters, invalid API key
         */
        $this->load->library('email');
        /* WHen there are multiple users, details will need to be pulled from DB */
        $this -> email
              ->from('james@jkamradcliffe.net', 'VMS')
              ->to('j.kamradcliffe1980@gmail.com')
              ->subject('Payment Received')
              ->set_mailtype('html')
              ->message('Dear Bert,<br/><br/> There\'s a bloody error');    
        $this->email->send();	       
        $error['partial'] = $this->load->view('templates/non_card_error', '', true);
      }
      else{
        /* 
         * For any other error, display a generic message
         * The error type willl be emailed to user
         */
        $error['partial'] = $this->load->view('templates/non_card_error', '', true);
      }
      $error['retry'] = "Click <a href='".$error['url']."'>HERE</a> or use your browser's back button to try again.";
      $error['exit'] = "To exit without completing your payment, click <a href='https://vmssecurepay.jkamradcliffe.net/index.php/payment_status/non_payment'>HERE</a>.";
      $this->load->view('payment_status', $error);
    }
    else{
      $charge = $this->session->userdata();
      
      $charge['heading'] = "Your payment was successful.";
      $charge['message'] = null;
      $payment_details = array('amount'=>($charge['amount_due']/100), 'email'=>$charge['email'], 'reference'=>$charge['reference']);
      $charge['partial'] = $this->load->view('templates/payment_successful', $payment_details, true);
      $charge['code'] = null;
      $charge['retry'] = null;
      $charge['exit'] = null;
      $this->load->view('payment_status', $charge);
      
      /* Notification of successful payment for User */
      $this->load->library('email');
      /* WHen there are multiple users, details will need to be pulled from DB */
      $this -> email
            ->from('james@jkamradcliffe.net', 'VMS')
            ->to('j.kamradcliffe1980@gmail.com')
            ->subject('Payment Received')
            ->set_mailtype('html')
            ->message('Dear Bert,<br/><br/> You\'ve received some money');    
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
    /* Notification of non-payment for User */
    $this->load->library('email');
//    $config['charset'] = 'utf-8';
//    $config['mailtype'] = 'text';    
//    $config['newline'] = "\r\n";
//    $this->email->initialize($config);
    /* WHen there are multiple users, details will need to be pulled from DB */
    $this -> email
          ->from('james@jkamradcliffe.net', 'VMS')
          ->to('j.kamradcliffe1980@gmail.com')
          ->subject('Payment Not Received')
          ->set_mailtype('html')
          ->message('Dear Bert, <br/><br/> You\'ve not received any money');    
    $this->email->send();	
  }
  
  
}

?>