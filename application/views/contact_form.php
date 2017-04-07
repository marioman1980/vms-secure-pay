<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>  

<section data-title="contact_form">
<div id="error" style="color:red"></div>
<form id="contact_form" name="contact_form" action="" method="post">
  <h4>Contact Us</h4>
  <p>If there's a problem with your payment or you need to get in touch, please use the form below and we'll respond as quickly as we can.</p><br/>
<!--  
  Start Form Inputs 
  HTML5 validation performed client-side
  Full validation/sanitization will be performed server-side

  Readonly fields will be pre-populated
-->     
    <div class="w3-row">
      <label class="w3-third">First Name</label>
      <input class="w3-twothird field shadow" id="first_name" name="first_name" type="text" required></input>
    </div>
    <div class="w3-row">
      <label class="w3-third">Last name</label>
      <input class="w3-twothird field shadow" id="last_name" name="last_name" type="text" ></input>	
    </div>
    <div class="w3-row">
      <label class="w3-third">Email</label>
      <input class="w3-twothird field shadow" id="email" name="email" type="email" required></input><br><br>		
    </div>
    <div class="w3-row">
      <label class="w3-third">Message</label>
      <div class="w3-twothird">
        <textarea id="message" class="shadow" name="message"></textarea><br><!-- End Form Inputs -->				
        <input id="submit" name="submit" type="submit" value="Submit"></input>
        <span> | </span><input id="cancel" type="button" value="Cancel"> 
      </div>
    </div>
  </form>

<!-- Start Reset form confirm modal -->
   <div id="reset_form" class="w3-modal">
      <div class="w3-modal-content" style="width:300px">
			 <div class="w3-container" style="width:300px">
				 <span id="close-reset-modal" class="w3-closebtn">&times;</span>
			 	 <p id="confirm_cancel">Are you sure you want to cancel?</p>
         <div><button id="cancel-yes" class="btn_cancel">Yes</button> | <button id="cancel-no" class="btn_cancel">No</button></div>
			 </div>
		</div>
  </div>
<!-- End Reset form confirm modal -->
</div>
</section>

<!--
<script>
  $(document).ready(function(){
    $(document).on('submit', '#contact_form', function(){	
       event.preventDefault();
       var form = $('#contact_form');
       var data_string = $(form).serialize();	

       $.ajax({
          type: 'POST',
          url: 'https://vmssecurepay.jkamradcliffe.net/index.php/contact_form/contact_form_submit',
          data: data_string,
          success: function(json){
            var obj = jQuery.parseJSON(json);
            console.log(obj.success);
            console.log(obj.error);
            $('#error').html(obj.error);
            if (obj.success == true){
              window.location.href = 'https://vmssecurepay.jkamradcliffe.net/index.php/contact_form/contact_success';
            }


            form.find('#submit').prop('disabled', true);                
          }		
        });
        return false;
     });
  });	
</script>-->
