<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE>
<html style="min-height:100%">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
  	<title>VMS Secure Payments</title> 
	<link rel="icon" href="images/logo.png">
	<link rel="stylesheet" type="text/css" href="css/w3css.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
<!--Ajax request passing form values to php-->	   
   <script>
	    $(document).ready(function(){
			  $(document).on('submit', '#details_for_email', function(){	
				   event.preventDefault();
				   var form = $('#details_for_email');
				   var data_string = $(form).serialize();	

				   $.ajax({
					    type: 'POST',
					    url: 'https://vmssecurepay.jkamradcliffe.net/index.php/email/htmlmail',
					    data: data_string,
					    success: function(json){
                var obj = jQuery.parseJSON(json);
                console.log(obj.success);
                console.log(obj.error);
                $('#error').html(obj.error);
                $('#email_sent_alert').html(obj.success);
                
                if ((obj.success) = "Email Sent!!"){
                  document.getElementById('email_sent').style.display='block';
                }

                //form.find('#submit').prop('disabled', true);                
              }		
				    });
				    return false;
			   });
		  });				
   </script>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
<!--Ajax request passing form values to php-->	
<!--
	<script>
		$(document).ready(function(){
			$(document).on('submit', '#details_for_email', function(){	
			event.preventDefault();
			var form = $('#details_for_email');
			var data_string = $(form).serialize();	
				
				$.ajax({
					type: 'POST',
					url: 'php/create_email.php',
					data: data_string,
					success: function(data){
						var data = $.parseJSON(data);
						$('#title_error').html(data.errors.title_error);
						$('#first_name_error').html(data.errors.first_name_error);
						$('#last_name_error').html(data.errors.last_name_error);
						$('#email_error').html(data.errors.email_error);						
						$('#agent_error').html(data.errors.agent_error);
						$('#agent_reference_error').html(data.errors.agent_reference_error);
						$('#resort_error').html(data.errors.resort_error);						
						$('#amount_due_error').html(data.errors.amount_due_error);
						$('#email_sent_alert').html(data.success.success);
						
						if ((data.success.success) == "Email sent"){
							document.getElementById('email_sent').style.display='block';
						}
						
						form.find('#submit').prop('disabled', true);
						
						
						
						$('#error').html(data.errors.message);
					}		
				});
			return false;
			});
		});				
	</script>	
-->
	
	
	

</head>

<body>
	<div id="container" class="w3-container">
		<div id="watermark">TEST SITE</div><!--REMOVE POST-DEVELOPMENT-->
		<header class="w3-container w3-padding-8">
			<div id="header-img"><img id="logo" src="images/vms_secure_header.jpg"><br>
<!--			   <span style="float:right;padding-top:2px">Powered by Stripe</span>-->
		   </div>	
			SITE UNDER DEVELOPMENT<br>TEST PURPOSES ONLY<!--REMOVE POST-DEVELOPMENT-->
			<br><hr>
		</header>	