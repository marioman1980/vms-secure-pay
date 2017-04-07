<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

  class USER_Controller extends MY_Controller {
    
    public function __construct()
    {
      parent::__construct(); 

      /* All controllers inheriting from this one will require the user to be logged in */
      if (!($this->session->userdata('user_verified'))){
        /* If user is not logged in, redirect to login */
        redirect(site_url('login'));
      }          
    } 

//    public function populate_form($user_type, $model, $table, $id_type, $id, $view){
//      $data[$user_type] = $this->$model->get_row($table, $id_type, $id);
//      
//      $this->load->view('templates/header');
//      $this->load->view($view, $data);
//      $this->load->view('templates/footer');       
//    }
    
    public function search($table, $model, $search, $view){
      $this->form_validation->set_rules('search', 'Search Term', array('required', 'trim', 'htmlspecialchars', 'regex_match[/^[a-zA-Z \-]*$/]'));

      /* Retrieve records based on search term */
      $data[$table] = $this->$model->$search($this->input->post('search'));

      $this->load->view('templates/header');
      $this->load->view($view, $data);
      $this->load->view('templates/footer');         
    }    
    
  }


?>