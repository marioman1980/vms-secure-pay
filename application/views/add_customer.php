<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php echo $customer->customer_id; ?>
<section data-title="add_customer" class="w3-container w3-padding-8">
	<div id="error" style="color:red"></div>
  <form id="add_update_customer" action="" method="post">   
		<!--  
        Start Form Inputs 
        HTML5 validation performed client-side
        Full validation/sanitization performed server-side
    -->
    <div class="w3-row">
      <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>" />
      <label class="w3-third">Title</label>
      <select class="w3-twothird field" id="title" name="title" style="width:70px" required>   
        <option value="" disabled selected><?php echo $customer->title; ?></option>	
        <?php
        //Loop used to populate dropdown
          $titles = array("Mr","Master","Ms","Miss","Mrs","Mx");
          for($i = 0;$i <= 5; $i++) echo '<option value="'.$titles[$i].'">'.$titles[$i].'</option>';
        ?>
      </select>
    </div>
    <div class="w3-row">
      <label class="w3-third">First Name</label>
      <input class="w3-twothird field shadow" id="customer_forename" name="customer_forename" type="text" value="<?php echo $customer->customer_forename; ?>" required />
    </div>  
    <div class="w3-row">
      <label class="w3-third">Last Name</label>
      <input class="w3-twothird field shadow" id="customer_surname" name="customer_surname" type="text" value="<?php echo $customer->customer_surname; ?>" required />
    </div>
    <div class="w3-row">
      <label class="w3-third">Email</label>
      <div class="w3-twothird">
        <input class="field shadow" id="email" name="email" type="email" value="<?php echo $customer->email; ?>" required style="width: 100%" /><br/>
        <input id="submit" name="submit" type="submit" value="Add/Update"></input>
        <span> | </span><input id="cancel" type="button" value="Cancel">  
        <span id="form-errors" style="color:red"></span>
        <span id="pass-match"></span>
      </div>
    </div>
	</form><br>



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


<!-- Clear form - HTML5 type="reset" not used as it doesn't allow for confirmation -->
<!--
<script>
  $('#cancel').click(function(){
    $('#reset_form').show();
  });
  
  $('#cancel-yes').click(function(){
    $('#add_update_customer').trigger("reset");
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
/* AJAX handles form submission */  
  $(document).ready(function(){
    $(document).on('submit', '#add_update_customer', function(){	
      event.preventDefault();
      var form = $('#add_update_customer');
      var data_string = $(form).serialize();	
      $.ajax({
        type: 'POST',
        url: 'https://jkamradcliffe.net/vmssecurepay/index.php/add_customer/add_new_customer',
        data: data_string,
        success: function(json){
          var obj = jQuery.parseJSON(json);
          if (obj.success == true){
            console.log("Success");
          }
          else{
            console.log("No success");
            $('#form-errors').html(obj.error); 
          }
        }		
      });
      return false;
    });
  });	
  
</script>-->
