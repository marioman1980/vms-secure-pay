<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

  class Display_payments extends USER_Controller {
      
    public function __construct()
    {
      parent::__construct();
      /* Load model */
      $this->load->model('payments_model');  
        
    }  

    public function index(){
        /* Get payments via model */
        $data['payments'] = $this->payments_model->get_all_payments();

        $this->load->view('templates/header');
        $this->load->view('display_payments', $data);
        $this->load->view('templates/footer');         
    }  
    
    public function delete_payment(){
      $payment_id = $this->input->post('hidden_delete');
      $this->payments_model->delete_payment($payment_id);
//      header('Location: '.site_url('display_payments'));
    }
  }

?>