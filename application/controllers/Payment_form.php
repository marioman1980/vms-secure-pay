<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class Payment_form extends CI_Controller {
   
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

      /* Load privacy policy */
      public function privacy_policy(){
        $this->load->view('templates/header');
        $this->load->view('privacy_policy');
        $this->load->view('templates/footer');      
      }  
    
      public function populate_form(){
        $this->load->view('templates/header');
        /* Convert serialized url segment back to array */
        $data = unserialize(urldecode($this->uri->segment(3)));
        if ($data !== false){
          /* Load payment form, passing details from $data array */
          $this->load->view('payment_form.php', $data);        
        } else {
          /* If url is not valid (likely user has tried to change it manually),
           * load custom(basic) error  view.
           *
           * This will prevent user changinging values.
           *
           * CI PHP error can be disabled in index.php by changing environment from development to production
           */
          $this->load->view('custom_url_error.php');        
        }
        $this->load->view('templates/footer'); 
      }
      
  }   
?>