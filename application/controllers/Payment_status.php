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
      else{
        /* 
         * For any other error, display a generic message
         * The error type willl be emailed to user
         */
        $error['partial'] = $this->load->view('templates/non_card_error', '', true);
      }
      $error['retry'] = "Click <a href='".$error['url']."'>HERE</a> or use your browser's back button to try again.";
      $this->load->view('payment_status', $error);
    }
    else{
      
      $charge['heading'] = "Your payment was successful.";
      $charge['message'] = null;
      $charge['partial'] = $this->load->view('templates/payment_successful', '', true);
      $charge['code'] = null;
      $charge['retry'] = null;
      $this->load->view('payment_status', $charge);
    }

    $this->load->view('templates/footer');
  } 
  
  
}

?>