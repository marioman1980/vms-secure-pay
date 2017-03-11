<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="w3-container">
  <section id="payment_status">
    <h4><?php echo $heading; ?></h4>
    <h6><?php echo $message; ?></h6>
    <?php echo $partial; ?>
    
    <?php
    if ($code != null){
      echo "Reason ".$code;
    }
    ?>
    <p><?php echo $retry; ?></p>
    <p><?php echo $exit; ?></p>
  </section>
</div>

