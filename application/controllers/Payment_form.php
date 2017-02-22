<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class Payment_form extends CI_Controller {
  
		/*
		* Index Page for this controller.
		*
		* Maps to the following URL
		* 		http://example.com/index.php/main
		*	- or -
		* 		http://example.com/index.php/main/index
		*	- or -
		* Since this controller is set as the default controller in config/routes.php, 
		* it's displayed at root of site folder : https://vmssecurepay.jkamradcliffe.net
		*/     
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

      public function privacy_policy(){
        $this->load->view('templates/header');
        $this->load->view('privacy_policy');
        $this->load->view('templates/footer');      
      }  
    
      public function populate_form(){
        $this->load->view('templates/header');
        /* Convert serialixed url segment back to array */
        $data = unserialize(urldecode($this->uri->segment(3)));
        /* Load payment form, passing details from $data array */
        $this->load->view('payment_form', $data);
        $this->load->view('templates/footer'); 
      }
      
  }   
?>