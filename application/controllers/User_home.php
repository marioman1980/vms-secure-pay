<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class User_home extends USER_Controller {
      
    public function __construct()
    {
      parent::__construct();   
    }      
      
		public function index() { 
         /* Load page comprising header and main content */
        $this->load_page('user_home');      
		}	 
 
  }   
?>