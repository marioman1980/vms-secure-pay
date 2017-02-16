<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');


class Test_email extends CI_Controller {

// public function htmlmail() {
//  $userName =  $_POST['title'];
//  $userPassword =  $_POST['first_name'];
//  $status = array("STATUS" => "false");
//  if($userName=='Mr' && $userPassword=='JAMES'){
//   $status = array("STATUS" => "true"); 
//  }
//  echo json_encode ($status) ; 
// }
   
   public function htmlmail(){
		 
	  	$response = array();
	    // load email library
	    $this->load->library('email');

	    $data = array(
		    'userName'=> $this->input->post('first_name'),
		    'year' => '1980'
	    );		 

	    // prepare email
	    $this -> email
			  ->from('james@jkamradcliffe.net', 'Example Inc.')
			  ->to('j.kamradcliffe1980@gmail.com')
			  ->subject('Hello from Example Inc.')
			  ->message($this->load->view('test_email.php', $data, true))
			  ->set_mailtype('html');

	    // send email
	    $this->email->send();	
	  	$response['success'] = "Email Sent!!";
	  echo json_encode ($response) ;
	}
}

?>