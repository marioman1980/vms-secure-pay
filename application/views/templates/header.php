<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE>
<html style="min-height:100%">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
  <script src="https://js.stripe.com/v2/"></script>
  <script src="https://js.stripe.com/v3/"></script>  <!-- v3 loaded for 'Elements' --> 
  <script src="<? echo base_url();?>js/sorttable.js"></script>
  
  <title>VMS Secure Payments</title> 
  <link rel="icon" href="<? echo base_url();?>images/logo.png">
  <link rel="stylesheet" type="text/css" href="<? echo base_url();?>css/w3css.css">
  <link rel="stylesheet" type="text/css" href="<? echo base_url();?>css/style.css">
  <style>/*For sticky footer*/
    #container:after {
      display: block;
      height: 150px
    }
    @media only screen and (min-width:601px){
      footer{width:80%; margin:auto}
    }
  </style>
  
	<script>//W3 function concerned with hiding/showing collapsible navigation
		function myFunction() {
			var collapsed_nav = document.getElementById("collapsed_nav");
			if (collapsed_nav.className.indexOf("w3-show") == -1) {
				collapsed_nav.className += " w3-show";
        $('#nav_container').css('background-color', 'white');
			} 
			else { 
				collapsed_nav.className = collapsed_nav.className.replace(" w3-show", "");
        $('#nav_container').css('background-color', 'transparent');
			}
      
		}
	</script>	
  
</head>

<body>
	<div id="container"  class="w3-container">
		<div id="watermark">TEST SITE</div><!--REMOVE POST-DEVELOPMENT-->
		<header class="">
<!--NAVIGATION-->
      <?php 
        if ($this->session->userdata('user_verified')){
          $this->view('templates/navigation');
        } 
      ?>
			<div id="header-img"><img id="logo" src="<? echo base_url();?>/images/vms_secure_header.jpg"><br>
<!--			   <span style="float:right;padding-top:2px">Powered by Stripe</span>-->
		   </div>	
			SITE UNDER DEVELOPMENT<br>TEST PURPOSES ONLY<!--REMOVE POST-DEVELOPMENT-->
     

			<br><hr>
		</header>	