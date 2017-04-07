<?php
class Login_model extends MY_Model {

  public function validate_user(){
    $this->db->where('username', $this->input->post('username'));
    $query = $this->db->get('users');
    if ($query->num_rows() == 0){
      return false;/* If username doesn't exist */
    }
    else{
      $row = $query->row();
      return $row; /* Return hash */      
    }
  }
  
  public function register_user($img_data){
    $user_id = $this->session->userdata('user_id');
    $this->db->where('username', $this->input->post('username'));
    $query = $this->db->get('users');
    if (($query->num_rows() != 0) && ($user_id == null)){
      return false;/* Username taken */
    }  
    else{
      $data = array(
        /* Inputs sanitised in controller */
        'user_first_name' => $this->input->post('user_first_name'),
        'user_last_name'  => $this->input->post('user_last_name'),
        'user_email'      => $this->input->post('user_email'),
        'company_name'    => $this->input->post('company_name'),
        'username'        => $this->input->post('username'),
        /* Bcrypt algorithm used to hash password */
        'password'        => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'logo_url'        => $img_data,
        'api_pk'          => $this->input->post('api_pk'),
        'api_sk'          => $this->input->post('api_sk')
        
      );

      $query = "insert into users (user_first_name, user_last_name, user_email, company_name, username, password, logo_url, api_pk, api_sk)
      values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    /* Method in MY_Controller */  
      return $this->create_record($user_id, $query, $data, 'user_id', 'users');
    }
  }
  
  public function delete_account($user_id){
  /* Delete user, customers and payments */  
    $query = $this->db->get_where('customers', array('user_id' => $user_id));
    foreach ($query->result_array() as $row){
      $this->delete_record('payments', 'customer_id', $row['customer_id']);
    }    
    $this->delete_record('customers', 'user_id', $user_id);    
    $this->delete_record('users', 'user_id', $user_id);

    

    
  }  
  
  
}