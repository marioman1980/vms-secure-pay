<?php
/*
 * This is a base class for models
 *
 * Common functions will be housed here
 */

class MY_Model extends CI_Model {
  
  public function __construct()
  {
    $this->load->database();
    $this->load->library('session'); 
  }  
  

/* CI automatically escapes values producing safer queries */  
  public function create_record($id, $query, $data, $column_id, $table){
    if ($id == null){
      $this->db->query($query, $data);  
      return $this->db->insert_id();      
    }
    else{
      $this->db->where($column_id, $id);
      $this->db->update($table, $data);  
      return true;
    }
  }
  
  public function get_row($table, $table_id, $id){
    $query = $this->db->get_where($table, array($table_id => $id));
    $row = $query->row();
    return $row;
  }  
  
  public function delete_record($table, $table_id, $id){
    $this->db->delete($table, array($table_id => $id));
  }
  
  
}
?>