<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="w3-container w3-padding-8">
  	<div id="error"></div>
  	<form id="details_for_email_link" action="" method="post">
		<!-- Start Form Inputs -->
		<label class="w3-third">Title</label>
    	<select class="w3-twothird" id="title" name="title" style="width:70px" required>   
      	<option value="" disabled selected>Select</option>	
			<?php
			//Loop used to populate dropdown
			  $titles = array("Mr","Master","Ms","Miss","Mrs","Mx");
			  for($i = 0;$i <= 5; $i++) echo '<option value="'.$titles[$i].'">'.$titles[$i].'</option>';
			?>
    	</select><br>
		<span class="error_message" id="title_error"></span><br>			
	 	<label class="w3-third">First Name</label>
 		<input class="w3-twothird" id="first_name" name="first_name" type="text" required>
			<span class="error_message" id="first_name_error"></span>
	 	</input><br><br>
 		<label class="w3-third">Last Name</label>
	 	<input class="w3-twothird" id="last_name" name="last_name" type="text" required>
			<span class="error_message" id="last_name_error"></span>
		</input><br><br>
	 	<label class="w3-third">Email</label>
	 	<input class="w3-twothird" id="email" name="email" type="email" required>
			<span class="error_message" id="email_error"></span>
		</input><br><br>
	 	<label class="w3-third">Agent</label>
	 	<input class="w3-twothird" id="agent" name="agent" type="text" required>
			<span class="error_message" id="agent_error"></span>
		</input><br><br>	
	 	<label class="w3-third">Reference</label>
	 	<input class="w3-twothird" id="agent_reference" name="agent_reference" type="text" required>
			<span class="error_message" id="agent_reference_error"></span>
		</input><br><br>					
	 	<label class="w3-third">Resort</label>
	 	<input class="w3-twothird" id="resort" name="resort" type="text" required>
			<span class="error_message" id="resort_error"></span>
		</input><br><br>				
	 	<label class="w3-third">Amount Due</label>
	 	<input class="w3-twothird" id="amount_due" name="amount_due" type="number" step="any" required>
			<span class="error_message" id="amount_due_error"></span>
		</input><br><br>
	 	<label class="w3-third">Message</label>
		<div class="w3-twothird">
			<textarea id="message" name="message"></textarea><br><!-- End Form Inputs -->				
			<input id="submit" name="submit" type="submit" value="Submit"></input>
			<span> | </span><span id="cancel">Cancel</span>
		</div>
	 	<span id="success"></span>
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
   
   <script>// Close Modal
	   $('#close-modal').click(function(){
			$('#email_sent').css('display', 'none');
		})			
	</script>

</section>