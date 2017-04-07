<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class My404 extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
  }    
  
  public function index(){
    $this->load_page('my404');    
  }
  
}