<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/* Libraries and methods for global use */
  class MY_Controller extends CI_Controller {
    
    public function __construct()
    {
      parent::__construct(); 

      $this->load->library('form_validation');           
      $this->load->library('session');    
      
    } 
    
    public function load_page($view){
      $this->load->view('templates/header');
      $this->load->view($view);
      $this->load->view('templates/footer');      
    }  
    
    public function populate_form($user_type, $model, $table, $id_type, $id, $view){
      $data[$user_type] = $this->$model->get_row($table, $id_type, $id);
      
      $this->load->view('templates/header');
      $this->load->view($view, $data);
      $this->load->view('templates/footer');       
    }    

  }


?>