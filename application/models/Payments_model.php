<?php
class Payments_model extends MY_Model {

  public function get_all_payments(){
    $this->db->select('*');
    $this->db->from('customers');
    $this->db->join('payments', 'payments.customer_id = customers.customer_id');   
    $this->db->where('user_id', $this->session->userdata('user_id'));
    $query = $this->db->get();

    return $query->result_array();
  }
  
  public function create_payment($customer_id){
    $data = array(
      /* Inputs sanitised in controller */
      'customer_id'       => $customer_id,
      'reference'         => $this->input->post('reference'),
      'payment_for'       => $this->input->post('payment_for'),
      'amount'            => $this->input->post('amount_due'),
      'status'            => 'UNPAID',
      'miscellaneous'     => $this->input->post('miscellaneous')
    );

    $query = "insert into payments (customer_id, reference, payment_for, amount, status, miscellaneous)
    values(?, ?, ?, ?, ?, ?)";
  /* Method in MY_Controller */    
    return $this->create_record(null, $query, $data, 'payment_id', 'payments');
 
  }
  
  public function update_payment_status($payment_id){
    $data = array('status' => 'PAID');
    $this->db->where('payment_id', $payment_id);
    $this->db->update('payments', $data);    
  }
  
  public function search_payments($search_term){

    if (!($search_term)){
      $this->db->select('*');
      $this->db->from('customers');
      $this->db->join('payments', 'payments.customer_id = customers.customer_id');   
      $this->db->where('user_id', $this->session->userdata('user_id'));
      $query = $this->db->get();        
    }
    else{
      $this->db->select('*');
      $this->db->from('customers');
      $this->db->join('payments', 'payments.customer_id = customers.customer_id');   
      $this->db->where('payment_id', $search_term);
      $this->db->or_like('customer_surname', $search_term);
      $this->db->or_where('reference', $search_term);
      $this->db->where('user_id', $this->session->userdata('user_id'));
      $query = $this->db->get();          
    }

    return $query->result_array();
  }
  
  public function delete_payment($payment_id){
    $this->delete_record('payments', 'payment_id', $payment_id);
  }
}