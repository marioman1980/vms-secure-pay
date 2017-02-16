<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
   class Main extends CI_Controller {
  
	/*
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/main
	 *	- or -
	 * 		http://example.com/index.php/main/index
	 *	- or -
	 * Since this controller is set as the default controller in config/routes.php, 
	 * it's displayed at root of site folder : https://jkamradcliffe.net/vmssecurepay
	 */     
      public function index() { 
         $this->load->view('templates/header');
         $this->load->view('main');
      }	     
   }   
?>