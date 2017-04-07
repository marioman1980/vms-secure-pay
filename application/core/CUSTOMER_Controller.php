<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/* Controllers inheriting from this class will not be able to access areas requiring login */
  class CUSTOMER_Controller extends MY_Controller {
    
    public function __construct()
    {
      parent::__construct(); 

    } 

  }


?>