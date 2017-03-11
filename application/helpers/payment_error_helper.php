<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function handle_error($data){
  
  if ($data['success'] == false){
    if ($data['type'] == 'card_error'){
      $data['heading'] = "Unable to process your request";
      $data['sub_reason'] = "Your card has been declined";
    }
    else{
      $data['heading'] = "HELLO";
    }
  }
  else{
    $data['heading'] = "BALLS";
  }
  return $data;

//      if ($data['type'] == 'card_error'){
//        return $data['decline_code'];
//      }
//      else{
//        return "Not card error";
//      }
  
  return $data;
  
}



?>