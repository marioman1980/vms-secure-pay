<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <form id="payment_form" name="payment_form" action="" method="post">
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
      <input class="w3-twothird field form_readonly" id="title" name="title" type="text" value="<?php echo $title; ?>" style="width:50px" required readonly></input>
    </div>
    <div class="w3-row">
      <label class="w3-third">First name</label>
      <input class="w3-twothird field form_readonly" id="first_name" name="first_name" type="text" value="<?php echo $first_name; ?>" required readonly></input>
    </div>
    <div class="w3-row">
      <label class="w3-third">Last name</label>
      <input class="w3-twothird field form_readonly" id="last_name" name="last_name" type="text" value="<?php echo $last_name; ?>" required readonly></input>	
    </div>
    <div class="w3-row">
      <label class="w3-third">Email</label>
      <input class="w3-twothird field form_readonly" id="email" name="email" type="email" value="<?php echo $email; ?>" required readonly></input><br><br>		
      <h4>Payment Details</h4>	
    </div>
    <div class="w3-row">
      <label class="w3-third">Reference</label>
      <input class="w3-twothird field form_readonly" id="reference" name="reference" type="text" value="<?php echo $reference; ?>" required readonly></input>
  <!--    <input class="w3-third input_margin form_readonly" id="reference" name="reference" type="hidden" readonly></input>-->
    </div>
    <div class="w3-row">
      <label class="w3-third">Amount Due</label>
      <input class="w3-twothird field form_readonly" id="amount_due" name="amount_due" type="text" value="<?php echo $amount_due; ?>" required readonly></input>
    </div>
    <div class="w3-row">
      <label class="w3-third">Cardholder's Name</label>
      <input class="w3-twothird field shadow" id="cardholder" name="cardholder" type="text" data-stripe="name" required></input>
    </div>
    <div class="w3-row">
      <label class="w3-third" for="card-element">Card Details</label>
      <div class="w3-twothird">
        <!-- CARD - Stripe Element mounted to div -->
        <div id="card-element" class="field shadow"></div> 
        <input id="submit_button" name="submit_button" type="submit" value="Submit"></input> 	
        <button id="privacy-policy-link"><a href="https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/privacy_policy">Privacy Policy</a></button>  <br> 
        <span id="card-errors" style="color:red"></span>
        <span id="errors" style="color:red"></span>
      </div>          
    </div>
  </form>
</div>

<script>
console.log($('#last_name').val());
</script>


<script>
/* Readonly fields  */
  $('.form_readonly').prop('readonly', true);
</script>

<!-- STRIPE PAYMENT -->
<script>
  /* Publishable API key */
  var stripe = Stripe('pk_test_hf3cRYT5E8wlB3f5X6b75d4R');
  var elements = stripe.elements();
  
  /* Custom styling can be passed to options when creating an Element. */
  var style = {
    base: {
      '::placeholder': {
        color: '#CFD7E0'
      }
    }
  };

  /* Create an instance of the card Element, with above styling */
  var card = elements.create('card', {style: style});

  /* Add an instance of the card Element into the `card-element` <div> */
  card.mount('#card-element');   
  
  /* Listen to change event and display error if invalid card details are entered */
  card.addEventListener('change', function(event) {
    if (event.error) {
      $('#card-errors').html(event.error.message);
    } else {
      $('#card-errors').html('');
    }
  });  
  
/*
* The next 3 functions are concerned with tokenizing
* Customer credit / debit card details and submitting 
* the form. with the token, to the server
*/  
  
  $('#submit_button').click(function(e){
    e.preventDefault(); /* Prevent form submission */
    /* Create token */
    stripe.createToken(card).then(function(result) {
      if (result.error) {
        /* Inform user if there's an error */
        $('#card-errors').html(result.error.message);
      } else {
        /* Insert token using hidden field so that it can be submitted */
        $('#payment_form').append($('<input type="hidden" name="stripeToken">').val(result.token.id));
        $('#payment_form').submit();         
      }
    }); 
  });
 
/* AJAX handles form submission */  
  $(document).ready(function(){
    $(document).on('submit', '#payment_form', function(){	
      event.preventDefault();
      var form = $('#payment_form');
      var data_string = $(form).serialize();	
      $.ajax({
        type: 'POST',
        url: 'https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/process_payment',
        data: data_string,
        success: function(json){
          var obj = jQuery.parseJSON(json);
          if (obj.success == true){
            window.location.href = 'https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/privacy_policy'
            $('#card-errors').html("There are no errors in the form");
            console.log("There are no errors in the form");
          }else{
            console.log("There are errors in the form");
            $('#card-errors').html("There are errors in the form");
            $('#errors').html(obj.error);           
          }

        }		
      });
      return false;
    });
  });		
  
  
  
//  function stripeTokenHandler(token) {
//    /* Insert token using hidden field so that i can be submitted */
//    $('#payment_form').append($('<input type="hidden" name="stripeToken">').val(token.id));
//    alert(token.id);
//
//    /* Submit the form */
//    $('#payment_form').get(0).submit();
//  }  
//  
//  function createToken() {
//    stripe.createToken(card).then(function(result) {
//      if (result.error) {
//        /* Inform user if there's an error */
//        $('#card-errors').html(result.error.message);
//      } else {
//        /* Call function to submit form with token */
//        stripeTokenHandler(result.token);
//        //alert(result.token.id);
//      }
//    });
//  }; 
//
//  /* Listen for submit event - call function which invokes token creation and form submission */
//  $('#payment_form').submit(function(e){
//    e.preventDefault();
//    createToken();
//  });  
  
</script>

































