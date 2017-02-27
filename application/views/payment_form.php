<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <form id="payment_form" name="payment_form_form" action="php/charge_customer.php" method="post">
    <span class="payment_errors" style="color:red"></span>
    <h4>Your Details</h4>
<!--  
  Start Form Inputs 
  HTML5 validation performed client-side
  Full validation/sanitization will be performed server-side

  Readonly fields will be pre-populated
-->     
    <div class="w3-row">
      <label class="w3-third">Title</label>
      <input class="w3-twothird field input_margin form_readonly" id="title" name="title" type="text" value="<?php echo $title; ?>" style="width:50px" required readonly></input>
    </div>
    <div class="w3-row">
      <label class="w3-third">First name</label>
      <input class="w3-twothird field input_margin form_readonly" id="first_name" name="first_name" type="text" value="<?php echo $first_name; ?>" required readonly></input>
    </div>
    <div class="w3-row">
      <label class="w3-third">Last name</label>
      <input class="w3-twothird field input_margin form_readonly" id="last_name" name="last_name" type="text" value="<?php echo $last_name; ?>" required readonly></input>	
    </div>
    <div class="w3-row">
      <label class="w3-third">Email</label>
      <input class="w3-twothird field input_margin form_readonly" id="email" name="email" type="email" value="<?php echo $email; ?>" required readonly></input><br><br>		
      <h4>Payment Details</h4>	
    </div>
    <div class="w3-row">
      <label class="w3-third">Reference</label>
      <input class="w3-twothird field input_margin form_readonly" id="agent_reference" name="agent_reference" type="text" value="<?php echo $reference; ?>" required readonly></input>
  <!--    <input class="w3-third input_margin form_readonly" id="reference" name="reference" type="hidden" readonly></input>-->
    </div>
    <div class="w3-row">
      <label class="w3-third">Amount Due</label>
      <input class="w3-twothird field input_margin form_readonly" id="amount_due" name="amount_due" type="text" value="<?php echo $amount_due; ?>" required readonly></input>
    </div>
    <div class="w3-row">
      <label class="w3-third">Cardholder's Name</label>
      <input class="w3-twothird field input_margin shadow" id="cardholder" name="cardholder" type="text" data-stripe="name"></input>
    </div>
    <div class="w3-row">
      <label class="w3-third" for="card-element">Card Number</label>
      <div class="w3-twothird">
        <!--CARD-->
        <div id="card-element" class="field input_margin shadow"></div> 
        <input id="submit_button" name="submit_button" type="submit" value="Submit"></input> 	
        <button id="privacy-policy-link"><a href="https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/privacy_policy">Privacy Policy</a></button>          
      </div>          
    </div>
<!--
    <div class="w3-row" style="background-color:red">
      <div class="w3-col m4 l4" style="background-color:green"> </div>
      <div class="w3-col m8 l8" style="background-color:blue">
        <input id="submit_button" name="submit_button" type="submit" value="Submit"></input> 	
        <a href="https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/privacy_policy" id="privacy-policy-link"><p>Privacy Policy</p></a>     
      </div>
    </div>
-->




  <!--Sensitive fields have no name as details will not be passed to server-->	
<!--    <input class="w3-twothird input_margin cc-number shadow" id="card_number" type="tel" title="Please enter a valid card number" autocomplete="cc-number" placeholder=" &#8226&#8226&#8226&#8226 &#8226&#8226&#8226&#8226 &#8226&#8226&#8226&#8226 &#8226&#8226&#8226&#8226" data-stripe="number" required>-->




<!--
    <label class="w3-third">Expiry Date</label>		
    <div class="w3-twothird input_margin">
      <select id="expiry_month" data-stripe="exp_month" required> 
        <option value="" disabled selected>MM</option> JS used to populate 
      </select>
      <select id="expiry_year" data-stripe="exp_year" required> 
        <option value="" disabled selected>YY</option> JS used to populate 
      </select><br>
    </div>
    <div class="w3-row">
      <label class="w3-third">Security Number</label>
      <input class="w3-twothird input_margin cc-cvc shadow" id="security_num" type="tel" title="Please enter a valid CVC" style="width:50px" autocomplete="off" placeholder=" &#8226&#8226&#8226" data-stripe="cvc" required></input>
    </div>
    <input id="submit_button" name="submit_button" type="submit" value="Submit"></input> 	
    <a href="https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/privacy_policy" id="privacy-policy-link"><p>Privacy Policy</p></a>
-->

  </form>
</div>
<script>
// Disable readonly fields  
  for (var i = 0; i < 6; i++){
    document.getElementsByClassName('form_readonly')[i].disabled = true;
  }
  
//// Populate month combo, with '0' before single digits  
//  function minTwoDigits(n) {
//    return (n < 10 ? '0' : '') + n;
//  }  
//  var monthSelect = document.getElementById('expiry_month');
//  for (var i = 1; i < 13; i++){
//    i = minTwoDigits(i);
//    var monthOption = document.createElement("option");
//    monthOption.textContent = i;
//    monthSelect.appendChild(monthOption);
//  }
//// Get current year - populate dropdown with next 10 year values  
//  year = parseInt(new Date().getFullYear().toString().substr(2,2));
//  var yearSelect = document.getElementById('expiry_year');
//  for (var i = year; i < (year + 11); i++){
//    var yearOption = document.createElement("option");
//    yearOption.textContent = i;
//    yearSelect.appendChild(yearOption);
//  }  
</script>

<!-- STRIPE PAYMENT -->
<script>
  /*Publishable API key */
  var stripe = Stripe('pk_test_hf3cRYT5E8wlB3f5X6b75d4R');
  var elements = stripe.elements();
  
  // Custom styling can be passed to options when creating an Element.
  var style = {
    base: {
      // Add your base input styles here. For example:
      '::placeholder': {
        color: '#CFD7E0',
      }
    }
  };


  // Create an instance of the card Element
  var card = elements.create('card', {style: style});

  // Add an instance of the card Element into the `card-element` <div>
  card.mount('#card-element');  
  

  
</script>
































