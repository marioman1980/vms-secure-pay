<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section data-title="login" class="w3-container w3-padding-8">
  <form id="login" action="" method="post">   
		<!--  
        Start Form Inputs 
        HTML5 validation performed client-side
        Full validation/sanitization performed server-side
    -->
    <div class="w3-row">
      <label class="w3-third">Username</label>
      <input class="w3-twothird field shadow" id="username" name="username" type="text" required />
    </div>  
    
    <div class="w3-row">
      <label class="w3-third">Password</label>
      <div class="w3-twothird">
        <input class="field shadow" id="password" name="password" type="password" style="width: 100%" required /><br/>
        <input id="submit" name="submit" type="submit" value="Login"></input>
        <span> | </span><a href="<?php echo site_url('login/register') ?>">Register</a>
        <span id="form-errors" style="color:red"></span>
      </div>
    
    </div>

	</form><br>


</section>

<!--
<script>
/* AJAX handles form submission */  
  $(document).ready(function(){
    $(document).on('submit', '#login', function(){	
      event.preventDefault();
      var form = $('#login');
      var data_string = $(form).serialize();	
      $.ajax({
        type: 'POST',
        url: 'https://jkamradcliffe.net/vmssecurepay/index.php/login/login',
        data: data_string,
        success: function(json){
          var obj = jQuery.parseJSON(json);
          if (obj.success == true){/* Password/username match */
            window.location.href = 'https://jkamradcliffe.net/vmssecurepay/index.php/user_home';
            console.log("Success");
          }else if ((obj.success == false) && (obj.pass == false)){
            $('#form-errors').html("<p>Username and password do not match</p>");
            console.log("Username and password do not match");
          }else if ((obj.success == false) && (obj.pass == null)){
            $('#form-errors').html("<p>Username doesn't exist</p>");
            console.log("Username doesn't exist");
          }else{
            console.log("There are errors in the form");
            $('#form-errors').html(obj.error); 
            console.log(obj.error);
          }
          console.log(obj.success);
          console.log(obj.pass);
          console.log(obj.id);
        }		
      });
      return false;
    });
  });	
  
</script>
-->

<script>
  localStorage.setItem('enableBtnDeleteAccount', false);
</script>