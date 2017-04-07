<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');


  class Login extends MY_Controller {
      
    public function __construct()
    {
      parent::__construct();
      /* Load model */
      $this->load->model('login_model');
      /* Load form helper */ 
      $this->load->helper(array('form'));   
    }      
      
  
		/*
		* Index Page for this controller.
		*
		* Maps to the following URL
    *     https://jkamradcliffe.net/vmssecurepay/index.php/
    * - or -
		* 		https://jkamradcliffe.net/vmssecurepay/index.php/login
		*	- or -
		* 		https://jkamradcliffe.net/vmssecurepay/index.php/login/index
		*	- or- 
    *     https://jkamradcliffe.net/vmssecurepay
		*/     
      
    public function index(){      
      $this->load_page('login');
    }
    
    public function register(){
      /* Load register form with null values */
      $user_id = $this->session->set_userdata('user_id', null);
      $data['user'] = (object)[
        'user_first_name' => null,
        'user_last_name'  => null,
        'user_email'      => null,
        'company_name'    => null,
        'username'        => null,
        'api_pk'          => null,
        'api_sk'          => null,
        'logo_url'        => null
      ];       
      
      $this->load->view('templates/header');
      $this->load->view('register', $data);
      $this->load->view('templates/footer');      
    }
    
    
    public function do_upload(){          
      $config['upload_path']          = './uploads/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 100;
      $config['max_width']            = 1024;
      $config['max_height']           = 768;

      $this->load->library('upload', $config);
      if($this->upload->do_upload('userfile')) {
        $img_data = $this->upload->data();
      }
      
      return $img_data['file_name'];
    }    
    
    
    public function user_registration(){ 
      /* Sanitize input */
      $this->form_validation->set_rules('user_first_name', 'First Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));
      $this->form_validation->set_rules('user_last_name', 'Last Name', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));   
      $this->form_validation->set_rules('user_email', 'Email', array('required', 'trim', 'valid_email'));   
      $this->form_validation->set_rules('company_name', 'Company Name', array('required', 'trim', 'htmlspecialchars'));  
      $this->form_validation->set_rules('username', 'Username', array('required', 'trim', 'htmlspecialchars'));  
      $this->form_validation->set_rules('password', 'Password', array('required', 'trim')); 
      $this->form_validation->set_rules('api_pk', 'Public API Key', array('required', 'trim')); 
      $this->form_validation->set_rules('api_sk', 'Secret API Key', array('required', 'trim')); 
      
      /* If there are errors, add messages to response */
      if ($this->form_validation->run() == FALSE) { 
        $response['success'] = false;
        $response['error'] = validation_errors();
      }else{
        $img_data = $this->do_upload();
        if ($this->login_model->register_user($img_data) == false){
          $response['success'] = false;  
          $response['user_exists'] = true;
        }
        else{
          $response['success'] = true;  
          $response['user_exists'] = false;
          /* If form OK, call method to insert record */        
          $this->login_model->register_user($img_data);  
        }
      }
      $response['user_verified'] = $this->session->userdata('user_verified');
      echo json_encode ($response);      
    }
    
    public function login(){

      $this->form_validation->set_rules('username', 'Username', array('required', 'trim'));
      $this->form_validation->set_rules('password', 'Password', array('required', 'trim'));

      /* If there are errors, add messages to response */
      if ($this->form_validation->run() == FALSE) { 
        $response['success'] = false;
        $response['error'] = validation_errors();
        $response['pass'] = null;
      }else{
        /* Validate username and password combination */
        if ($this->login_model->validate_user() == false){
          $response['success'] = false;
          $response['pass'] = null;
        }
        else{
          $user_record = $this->login_model->validate_user(); 
          $user_id = $user_record->user_id;
          $hash = $user_record->password;/* Get hashed p/word from DB */
          /* Check user input with hash */
          if (password_verify($this->input->post('password'), $hash)){
            $response['success'] = true;  
            $response['pass'] = true;
            /* Session variable to allow access to next page */
            $this->session->set_userdata('user_verified', true);
            $this->session->set_userdata('user_id', $user_id);
            $response['id'] = $user_id;
          }
          else{
            $response['success'] = false;
            $response['pass'] = false;
          }          
        }
      }
      echo json_encode ($response);
    }
    
    public function logout(){
      $this->session->sess_destroy();
      $this->index();
    }    
    
    public function edit_user(){
      $user_id = $this->session->userdata('user_id');
      $this->populate_form('user', 'login_model', 'users', 'user_id', $user_id, 'register');     
    }
    
    public function delete_account(){
      $user_id = $this->session->userdata('user_id');
      $this->login_model->delete_account($user_id);
      $this->logout();     
    }
  }   
?>