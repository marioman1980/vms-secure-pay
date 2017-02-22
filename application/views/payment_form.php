<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <form id="payment_form" action="php/charge_customer.php" method="post">
    <span class="payment_errors" style="color:red"></span>
    <h4>Your Details</h4>
<!--  
  Start Form Inputs 
  HTML5 validation performed client-side
  Full validation/sanitization will be performed server-side

  Readonly fields will be pre-populated
-->      
    <label class="w3-third">Title</label>
    <input class="w3-twothird input_margin form_readonly" id="title" name="title" type="text" value="<?php echo $title; ?>" style="width:50px" required readonly></input><br><br>
    <label class="w3-third">First name</label>
    <input class="w3-twothird input_margin form_readonly" id="first_name" name="first_name" type="text" value="<?php echo $first_name; ?>" required readonly></input><br><br>
    <label class="w3-third">Last name</label>
    <input class="w3-twothird input_margin form_readonly" id="last_name" name="last_name" type="text" value="<?php echo $last_name; ?>" required readonly></input>	<br><br>		
    <label class="w3-third">Email</label>
    <input class="w3-twothird input_margin form_readonly" id="email" name="email" type="email" value="<?php echo $email; ?>" required readonly></input><br><br>		
    <h4>Payment Details</h4>			
    <label class="w3-third">Reference</label>
    <input class="w3-twothird input_margin form_readonly" id="agent_reference" name="agent_reference" type="text" value="<?php echo $reference; ?>" required readonly></input><br><br>
<!--    <input class="w3-third input_margin form_readonly" id="reference" name="reference" type="hidden" readonly></input>-->
    <label class="w3-third">Amount Due</label>
    <input class="w3-twothird input_margin form_readonly" id="amount_due" name="amount_due" type="number" step="any" value="<?php echo $amount_due; ?>" required readonly></input><br><br>
    <label class="w3-third">Cardholder's Name</label>
    <input class="w3-twothird input_margin" id="cardholder" name="cardholder" type="text" data-stripe="name"></input><br><br>			
    <label class="w3-third">Card Number</label>
  <!--Sensitive fields have no name as details will not be passed to server-->	
    <input class="w3-twothird input_margin cc-number" id="card_number" type="tel" title="Please enter a valid card number" autocomplete="cc-number" placeholder=" &#8226&#8226&#8226&#8226 &#8226&#8226&#8226&#8226 &#8226&#8226&#8226&#8226 &#8226&#8226&#8226&#8226" data-stripe="number" required>
    <label class="w3-third">Expiry Date</label>		
    <div class="w3-twothird input_margin">
      <select id="expiry_month" data-stripe="exp_month" required> 
        <option value="" disabled selected>MM</option><!-- JS used to populate -->
      </select>
      <select id="expiry_year" data-stripe="exp_year" required> 
        <option value="" disabled selected>YY</option><!-- JS used to populate -->
      </select><br>
    </div>
    <div class="w3-row">
      <label class="w3-third">Security Number</label>
      <input class="w3-twothird input_margin cc-cvc" id="security_num" type="tel" title="Please enter a valid CVC" style="width:50px" autocomplete="off" placeholder=" &#8226&#8226&#8226" data-stripe="cvc" required></input>
    </div>
    <input id="submit_button" name="submit_button" type="submit" value="Submit"></input> 	
    <a href="https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/privacy_policy" id="privacy_policy"><p>Privacy Policy</p></a>

  </form>
</div>
<script>
// Populate month combo, with '0' before single digits  
  function minTwoDigits(n) {
    return (n < 10 ? '0' : '') + n;
  }  
  var monthSelect = document.getElementById('expiry_month');
  for (var i = 1; i < 13; i++){
    i = minTwoDigits(i);
    var monthOption = document.createElement("option");
    monthOption.textContent = i;
    monthSelect.appendChild(monthOption);
  }
// Get current year - populate dropdown with next 10 year values  
  year = parseInt(new Date().getFullYear().toString().substr(2,2));
  var yearSelect = document.getElementById('expiry_year');
  for (var i = year; i < (year + 11); i++){
    var yearOption = document.createElement("option");
    yearOption.textContent = i;
    yearSelect.appendChild(yearOption);
  }  
</script>