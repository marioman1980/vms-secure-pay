<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<section class="w3-container w3-padding-8 w3-content">

  <div id="home-btn-wrapper">
    <div class="w3-row w3-content">
      <a href="<?php echo site_url('main'); ?>"><button class="w3-padding home_btn">Request Payment</button></a>
    </div>
    <div class="w3-row">
      <a href="<?php echo site_url('display_payments'); ?>"><button class="w3-padding home_btn">View Payments</button></a>
    </div>
    <div class="w3-row">
      <a href="<?php echo site_url('display_customers'); ?>"><button class="w3-padding home_btn">View Customers</button></a>
    </div>
    <div class="w3-row">
      <a href="<?php echo site_url('add_customer'); ?>"><button class="w3-padding home_btn">Add Customer</button></a>
    </div>
    <div class="w3-row">
      <a href="<?php echo site_url('login/edit_user'); ?>"><button id="btn-account-details" class="w3-padding home_btn">Account Details</button></a>
    </div>
    <div class="w3-row">
      <a href="<?php echo site_url('login/logout'); ?>"><button class="w3-padding home_btn">Logout</button></a>
    </div>
  </div>
  
</section>

<script>
  $('#btn-account-details').click(function(){
    localStorage.setItem('enableBtnDeleteAccount', true);
    console.log(localStorage.getItem('enableBtnDeleteAccount'));
  });


</script>
  

  


