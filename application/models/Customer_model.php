<?php
class Customer_model extends MY_Model {

//  public function __construct()
//  {
//    $this->load->database();
//    $this->load->library('session'); 
//  }
  
  public function register_customer(){
    $customer_id = $this->input->post('customer_id');
    $data = array(
      /* Inputs sanitised in controller */
      'user_id'           => $this->session->userdata('user_id'),
      'title'             => $this->input->post('title'),
      'customer_forename' => $this->input->post('customer_forename'),
      'customer_surname'  => $this->input->post('customer_surname'),
      'email'             => $this->input->post('email')
    );
    $query = "insert into customers (user_id, title, customer_forename, customer_surname, email)
    values(?, ?, ?, ?, ?)";
  /* Method in MY_Controller */    
    return $this->create_record($customer_id, $query, $data, 'customer_id', 'customers');
  }  
  
  /* 
   * If this is a customer's first payment,
   * we can give them an ID provided by Stripe so that future payments can be made
   * against them without creating a new customer in Stripe
   */
  public function update_stripe_id($customer_id, $stripe_id){
    $data = array('stripe_id' => $stripe_id);
    $this->db->where('customer_id', $customer_id);
    $this->db->update('customers', $data);     
  }
  
  public function show_all_customers(){
    $query = $this->db->get_where('customers', array('user_id' => $this->session->userdata('user_id')));
    return $query->result_array();
  }
  
  /* Input sanitised in controller */
  public function search_customers($search_term){
    $this->db->where('customer_id', $search_term);
    $this->db->where('user_id', $this->session->userdata('user_id'));
    $this->db->or_like('customer_surname', $search_term);
    $this->db->where('user_id', $this->session->userdata('user_id'));
    $query = $this->db->get('customers');
    return $query->result_array();
  }
  
  public function delete_customer($customer_id){
  /* Delete customer and associated payments */  
    $this->delete_record('payments', 'customer_id', $customer_id);
    $this->delete_record('customers', 'customer_id', $customer_id);
    
  }  

}