<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<section data-title="register" class="w3-container w3-padding-8">
<!-- Helper used to create correct syntax for logo image upload -->
  <?php 
        $attributes = array('id' => 'register');
        echo form_open_multipart('', $attributes); 
  ?>
		<!--  
        Start Form Inputs 
        HTML5 validation performed client-side
        Full validation/sanitization performed server-side
    -->

    <div class="w3-row">
      <label class="w3-third">First Name</label>
      <input class="w3-twothird field shadow" id="user-first-name" name="user_first_name" type="text" value="<?php echo $user->user_first_name; ?>" required />
    </div>   
    <div class="w3-row">
      <label class="w3-third">Last Name</label>
      <input class="w3-twothird field shadow" id="user-last-name" name="user_last_name" type="text" value="<?php echo $user->user_last_name; ?>" required />
    </div>  
    <div class="w3-row">
      <label class="w3-third">Email</label>
      <input class="w3-twothird field shadow" id="user-email" name="user_email" type="email" value="<?php echo $user->user_email; ?>" required />
    </div>    
    <div class="w3-row">
      <label class="w3-third">Company Name</label>
      <input class="w3-twothird field shadow" id="company-name" name="company_name" type="text" value="<?php echo $user->company_name; ?>" required />
    </div>   
    <div class="w3-row">
      <label class="w3-third">Username</label>
      <input class="w3-twothird field shadow" id="username" name="username" type="text" value="<?php echo $user->username; ?>" required />
    </div>  
    <div class="w3-row">
      <label class="w3-third">Password</label>
      <input class="w3-twothird field shadow" id="password" name="password" type="password" required />
    </div>      
    <div class="w3-row">
      <label class="w3-third">Confirm Password</label>
      <input class="w3-twothird field shadow" id="confirm-password" name="confirm_password" type="password" required />
    </div>  
    <div class="w3-row">
      <label class="w3-third">Public API Key</label>
      <input class="w3-twothird field shadow" id="api_pk" name="api_pk" type="text" value="<?php echo $user->api_pk; ?>" required />
    </div>      
    <div class="w3-row">
      <label class="w3-third">Secret API Key</label>
      <input class="w3-twothird field shadow" id="api_sk" name="api_sk" type="text" value="<?php echo $user->api_sk; ?>" required />
    </div>      
    
    <div class="w3-row">
      <label class="w3-third">Logo URL</label>
      <div class="w3-twothird">
        Upload your logo to add your brand to emails sent. Images must be 300 x 100 pixels with .jpg or .png file extension.
        <br/>
        <input type="file" id=" logo-upload" name="userfile" size="20" /><br/><br/>
<!--        <input class="field shadow" id="logo-url" name="logo_url" type="text" style="width: 100%" value="<?php //echo $user->logo_url; ?>" /><br/>-->
        <input id="submit" name="submit" type="submit" value="<?php if ($this->session->userdata('user_verified') == true){ echo 'Update'; } else{ echo 'Register';} ?>"></input>
        <span> | </span><input id="cancel" type="button" value="Cancel"> 
<!--
        <form style="width:auto; float:right; margin-right:2px" method="post" action="" id="delete-account">
          <input id="hidden-delete" name="hidden_delete" type="hidden"/>
          <button type="submit" id="btn-delete-account" name="btn_delete_account" style="float: right;padding-top:4px" hidden formnovalidate>Delete Account</button>
        </form>       
--><input type="hidden" id="delete-account" />
      <button id="btn-delete" style="float: right;padding-top:4px" hidden formnovalidate>Delete Account</button>
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

   <div id="delete-confirm-modal" class="w3-modal">
      <div class="w3-modal-content" style="width:300px">
			 <div class="w3-container" style="width:300px">
				 <span id="close-delete-modal" class="w3-closebtn">&times;</span>
			 	 <p id="confirm-delete">Are you sure you want to delete your account?<br/><br/>All account details, customer details and associated payments will be lost.<br/><br/>This action cannot be reversed.</p>
         <div><button id="delete-yes" class="btn_cancel">Yes</button> | <button id="delete-no" class="btn_cancel">No</button></div>
			 </div>
		</div>
  </div>  


</section>


<!--
<script>
  /* Check passwords match */
  $('#password, #confirm-password').on('keyup', function () {
    if ($('#password').val() == $('#confirm-password').val()) {
      $('#pass-match').html('<p>Passwords match</p>').css('color', 'green');
    } else 
      $('#pass-match').html('<p>Passwords don\'t match</p>').css('color', 'red');
  });
</script>
-->

<!--
<script>
/* AJAX handles form submission */  
  $(document).ready(function(){
    $(document).on('submit', '#register', function(){	
      event.preventDefault();
      /* Prevent submission if passwords don't match */
      if ($('#password').val() != $('#confirm-password').val()) {
        $('#pass-match').html('<p>Passwords don\'t match</p>').css('color', 'red');
      }
      else{
        var form = $('#register');
        var data_string = $(form).serialize();	
        $.ajax({
          type: 'POST',
          url: 'https://jkamradcliffe.net/vmssecurepay/index.php/login/user_registration',
          data: data_string,
          success: function(json){
            var obj = jQuery.parseJSON(json);
            if (obj.success == true){

              alert("Registration Successful \nPlease Log in");
              window.location.href = 'https://jkamradcliffe.net/vmssecurepay/index.php/login';                

            }else if ((obj.success == false) && (obj.user_exists == true)){
              $('#form-errors').html("<p>Username already exists</p>"); 
            }
            else{
              console.log("There are errors in the form");
              $('#form-errors').html(obj.error); 
              console.log(obj.error);
            }
            console.log(obj.success);
          }		
        });        
      }
      return false;
    });
  });	
  
</script>
-->

<!--
<script>
  $(document).ready(function(){
    if (localStorage.getItem('enableBtnDeleteAccount') == 'true'){
      $('#btn-delete-account').removeAttr('hidden');
    }
  });
</script>
-->
<script>
  $('#delete-account').click(function(){
    window.location = "<?php echo site_url('login/delete_account'); ?>";
  });


</script>









