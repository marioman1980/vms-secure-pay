<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_errors {
  
  public $data = array();

  public function __construct($params){
    $this->data = $params;
  }
  
  
  public function handle_error(){
    if ($this->data['success'] == false){
      if ($this->data['type'] == 'card_error'){
        return $this->data['decline_code'];
      }
      else{
        return "Not card error";
      }

    }
    else{
      return 'bar';
    }     
  }
}