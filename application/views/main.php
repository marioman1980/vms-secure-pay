<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<section data-title="payment_request" class="w3-container w3-padding-8">
	<div id="error" style="color:red"></div>
  <form id="details_for_email" action="" method="post">   
		<!--  
        Start Form Inputs 
        HTML5 validation performed client-side
        Full validation/sanitization performed server-side
    -->
    <div class="w3-row">
      <label class="w3-third">Title</label>
      <select class="w3-twothird field" id="title" name="title" style="width:70px" required>   
        <option value="<?php echo $customer->title; ?>" disabled selected><?php echo $customer->title; ?></option>	
        <?php
        //Loop used to populate dropdown
          $titles = array("Mr","Master","Ms","Miss","Mrs","Mx");
          for($i = 0;$i <= 5; $i++) echo '<option value="'.$titles[$i].'">'.$titles[$i].'</option>';
        ?>
      </select>
    </div>
    <div class="w3-row">
      <label class="w3-third">First Name</label>
      <input class="w3-twothird field shadow" id="first_name" name="customer_forename" type="text" value="<?php echo $customer->customer_forename; ?>" required />
    </div>  
    <div class="w3-row">
      <label class="w3-third">Last Name</label>
      <input class="w3-twothird field shadow" id="last_name" name="customer_surname" type="text" value="<?php echo $customer->customer_surname; ?>" required />
    </div>
    <div class="w3-row">
      <label class="w3-third">Email</label>
      <input class="w3-twothird field shadow" id="email" name="email" type="email" value="<?php echo $customer->email; ?>" required />
    </div>
    <div class="w3-row">
      <label class="w3-third">Payment For</label>
      <input class="w3-twothird field shadow" id="payment_for" name="payment_for" type="text" required />
    </div>
    <div class="w3-row">
      <label class="w3-third">Reference</label>
      <input class="w3-twothird field shadow" id="reference" name="reference" type="text" required />
    </div>
    <div class="w3-row">
      <label class="w3-third">Miscellaneous</label>
      <input class="w3-twothird field shadow" id="miscellaneous" name="miscellaneous" type="text" value="For your records. Customers won't see this" style="color:#999999"/>
    </div>
    <div class="w3-row">
      <label class="w3-third">Amount Due</label>
      <input class="w3-twothird field shadow" id="amount_due" name="amount_due" type="text" step="any" required />
    </div>
    <div class="w3-row">
      <label class="w3-third">Message</label>
      <div class="w3-twothird">
        <textarea id="message" class="shadow" name="message"></textarea><br><!-- End Form Inputs -->				
        <input id="submit" name="submit" type="submit" value="Submit"></input>
        <span> | </span><input id="cancel" type="button" value="Cancel">
      </div>
      <span id="success"></span>
    </div>
	</form><br>

<!-- Start Email Sent alert modal -->
   <div id="email_sent" class="w3-modal">
      <div class="w3-modal-content" style="width:300px">
			 <div class="w3-container" style="width:300px">
				  <span id="close-modal" class="w3-closebtn">&times;</span>
			 	  <p id="email_sent_alert"></p>
			 </div>
		</div>
  </div>
<!-- End Email Sent alert modal -->

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
</section>
   
<!-- Close email sent modal -->
<script>
   $('#close-modal').click(function(){
      $('#email_sent').hide();
   }); 
</script>



<!--Format 'amount due' as currency-->	
	<script>
		$('#amount_due' ).focusout(function() {
			var a = $('#amount_due').val();
			a = Number(a).toFixed(2);
			$( "#amount_due" ).val(a);
		});
	</script>

<!-- Clear form - HTML5 type="reset" not used as it doesn't allow for confirmation -->
<!--
<script>
  $('#cancel').click(function(){
    $('#reset_form').show();
  });
  
  $('#cancel-yes').click(function(){
    $('#details_for_email').trigger("reset");
    $('#reset_form').hide();
  });
   $('#cancel-no').click(function(){
      $('#reset_form').hide();
   });	  
  
   $('#close-reset-modal').click(function(){
      $('#reset_form').hide();
   });	     
</script>
-->

<!--
<script>
  $(document).ready(function(){
    $(document).on('submit', '#details_for_email', function(){	
       event.preventDefault();
       var form = $('#details_for_email');
       var data_string = $(form).serialize();	

       $.ajax({
          type: 'POST',
          url: 'https://jkamradcliffe.net/vmssecurepay/index.php/email/htmlmail',
          data: data_string,
          success: function(json){
            var obj = jQuery.parseJSON(json);
            console.log(obj.success);
            console.log(obj.error);
            $('#error').html(obj.error);
            $('#email_sent_alert').html(obj.success);

            $('#email_sent').show();
            //document.getElementById('email_sent').style.display='block';

            if (obj.success == "Email Sent!!"){
              form.find('#submit').prop('disabled', true);
            }
              
          }		
        });
        return false;
     });
  });	
</script>
-->

<!--
<script>
  removePlaceholderText($('#miscellaneous'), 'For your records. Customers won\'t see this');
</script>
-->


<script>
  $('#submit').click(function(){
    console.log($('select#title option:checked').val());
    if ($('select#title option:checked').val() != 'Select'){
      $('select#title option:checked').removeAttr('disabled');
    }
  });

</script>
