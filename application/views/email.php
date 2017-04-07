<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!--	<title>[SUBJECT]</title>-->
	<style type="text/css">
/*    table, tr, td{border: solid 1px black}*/
	#outlook a {padding:0;}
		body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
		.ExternalClass {width:100%;}
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
		a img {border:none;}
		.image_fix {display:block;}
		p {margin: 1em 0;}
		h1, h2, h3, h4, h5, h6 {color: black !important;}

		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
			color: red !important; 
		 }

		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
			color: purple !important; 
		}

		table td {border-collapse: collapse;}

		table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

		a {color: #000;}

		@media only screen and (max-device-width: 480px) {

			a[href^="tel"], a[href^="sms"] {
        text-decoration: none;
        color: black; /* or whatever your want */
        pointer-events: none;
        cursor: default;
      }

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
        text-decoration: default;
        color: orange !important; /* or whatever your want */
        pointer-events: auto;
        cursor: default;
      }
		}


		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			a[href^="tel"], a[href^="sms"] {
						text-decoration: none;
						color: blue; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
						text-decoration: default;
						color: orange !important;
						pointer-events: auto;
						cursor: default;
					}
		}

		@media only screen and (-webkit-min-device-pixel-ratio: 2) {
			/* Put your iPhone 4g styles in here */
		}

		@media only screen and (-webkit-device-pixel-ratio:.75){
			/* Put CSS for low density (ldpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1){
			/* Put CSS for medium density (mdpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1.5){
			/* Put CSS for high density (hdpi) Android layouts in here */
		}
		/* end Android targeting */
.bgBody{
  background: #ffffff;
}
.bgItem{
  background: #ffffff;
}
h2{
 color:#181818;
 font-family:Helvetica, Arial, sans-serif;
 font-size:22px;
 font-weight: normal;
}
p{
  color:#555;
  font-family:Helvetica, Arial, sans-serif;
  font-size:16px;
  line-height:160%;
}
span{
  color:#555;
  font-family:Helvetica, Arial, sans-serif;
  font-size:16px;
  line-height:160%;
}
        .btn-primary:hover {
          background-color: #34495e !important; }
    

</style>
<script type="colorScheme" class="swatch active">
  {
    "name":"Default",
    "bgBody":"ffffff",
    "link":"000000",
    "color":"555555",
    "bgItem":"ffffff",
    "title":"181818"
  }
</script>

</head>
<body><!-- Main Container -->
	<table cellpadding="0" width="100%" cellspacing="0" border="0" id="backgroundTable" class='bgBody'>
    <tr>
		  <td>
		    <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class='bgItem'>
          <tr>
				    <td class='movableContentContainer'>
				      <div class='movableContent'>
                <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
						      <tr height="10">
                    <td width="200">&nbsp;</td>
                    <td width="200">&nbsp;</td>
                    <td width="200">&nbsp;</td>
                  </tr>
                  <tr>
<!--                    <td width="200" valign="top">&nbsp;</td>-->
                    <td width="200" valign="top" align="left"><!-- Logo -->
                      <div class="contentEditableContainer contentImageEditable" >
                        <div class="contentEditable" >
                          <img src="https://vmssecurepay.jkamradcliffe.net/uploads/<?php echo $img; ?>" width="150" height="150"  ata-default="placeholder" alt='Logo'/>
                        </div>
                      </div>
                    </td><!-- End Logo -->
                    <td width="400" valign="top">&nbsp;</td>
						      </tr>
						      <tr height="5">
                    <td width="200">&nbsp;</td>
                    <td width="200">&nbsp;</td>
                    <td width="200">&nbsp;</td>
						      </tr>
                </table>
				      </div>
				      <div class='movableContent'>
					      <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
						      <tr>
                    <td width="50">&nbsp;</td>
                    <td width="500" colspan="3" align="center">
                      <div class="contentEditableContainer contentTextEditable" >
                        <div class="contentEditable" >
                          <h2>Your Payment Details</h2>
                        </div>
                      </div>
							      </td>
                    <td width="50">&nbsp;</td>
						      </tr>
						      <tr>
                    <td width="50">&nbsp;</td>
                    <td width="500" align="center"><!-- Content -->
								      <div class="contentEditableContainer contentTextEditable" >
                        <div class="contentEditable" >
                           <span><?php echo $payment_for; ?><br>
                          <?php echo $reference; ?><br></span>
                        </div>
                      </div>
							      </td>
							      
						      </tr>
					      </table>
				      </div>
              <div class='movableContent'>
                <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
                  <tr>
                    <td width="50">&nbsp;</td>
                    <td width="500" align="left" style="padding-bottom:15px;">
                      <div class="contentEditableContainer contentTextEditable">
                          <div class="contentEditable" >
                            <p>
                              Dear <?php echo $title.' '.$last_name; ?>,
                              <br /><br>
                              <?php echo $message; ?><br />
                              <br />
                              <span><?php echo $username; ?></span><br />
<!--                              <strong>Reservation Team Management</strong><br>-->
                              <strong><?php echo $company; ?></strong>
										        </p>
                          </div>
                        </div>
							       </td>
							       <td width="50">&nbsp;</td>
						       </tr>
					       </table>
				      </div>


				<div class='movableContent'><!-- Payment Info -->
					<table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
						<tr>
              <td width="50"></td>
              <td width="500" align="center" height='30'><span>Click below to complete your payment for <strong><?php echo '£'.$amount_due; ?></strong> securely with VMS Secure Payments</span></td>
              <td width="50"></td>
            </tr>
            <tr><td height="20" colspan="3"></td></tr>
						<tr>
							<td width="50">&nbsp;</td>
							<td width="500" align="center" >
								<table cellpadding="0" cellspacing="0" border="0" align="center" width="250" height="50">
									<tr><!-- CTA -->
										<td class="btn-primary" bgcolor="#3498DB" align="center" style="border-radius:4px;" width="250" height="50">
											<div class="contentEditableContainer contentTextEditable" >
                          <div class="contentEditable" style='text-align:center;'>
                              <a target='_blank' href="<?php echo $url; ?>" style="color:#fff;text-decoration:none;font-family:Helvetica, Arial, sans-serif;font-size:16px;color:#fff;border-radius:4px;">Complete Payment</a>
                          </div>
                      </div>
										</td><!-- End CTA -->
									</tr>

								</table>
							</td>
							<td width="50">&nbsp;</td>
						</tr>
						<tr><td height="10" colspan="3"></td></tr>            

						<tr>
							<td width="50">&nbsp;</td>
							<td width="500" align="left" >
								<div class="contentEditableContainer contentTextEditable" >
                  <div >
										<p>If you're not directed to the VMS Secure Payments page, copy and paste the following into your browser:</p>
                    <span><a href="#">https://URL</a></span>
                  </div>
                </div>
								
							</td>
							<td width="50">&nbsp;</td>
						</tr>
            <tr><td height="20" colspan="3"></td></tr>
					</table>
				</div><!-- End Content -->
								
				
				<div class='movableContent'>				
					<table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
              <!-- Footer Info -->
						<tr>
              <td width="50">&nbsp;</td>
							<td width="350px" height="70" valign="middle" style="padding-bottom:20px;">
							<div class="contentEditableContainer contentTextEditable">
								<div class="contentEditable" >
									<span style="font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;">Sent to <?php echo $email; ?> by VMS</span>
									<br/>
									<span style="font-size:11px;color:#555;font-family:Helvetica, Arial, sans-serif;line-height:200%;">Tel: 01234 567891<br>
                  Address: 123 The Street, Town, Postcode</span>
									<br/>

								</div>
							</div>
								
							</td>
							<td height="70" align="right" valign="top" align='right' style="padding-bottom:20px;">
								<table border="0" cellspacing="0" cellpadding="0" align='right'>
									<tr>

										<td valign="top">
											<div class="contentEditableContainer contentFacebookEditable" style='display:inline;'>
                          <div class="contentEditable" >
                            <a href="#"><img src="https://vmssecurepay.jkamradcliffe.net/images/vms_secure_header.jpg" width='150' height='30' ata-default="placeholder" alt='VMS Secure Pay'></a>
                          </div>
                      </div>
										</td>
										
                  </tr>
                </table>
              </td>
              
									
								
<!--							</td>-->
              <td width="50">&nbsp;</td>
						</tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td>Email template adapted from: 
                <span style="font-size:11px;color:#555;font-family:Helvetica, Arial, sans-serif;line-height:200%;"><a href="http://templates.cakemail.com/details/read%20me">templates.cakemail.com</a></span>
              </td>
              <td width="150">&nbsp;</td>
            </tr>
					</table>
				</div>


				</td>
			</tr>
		</table>

		

		</td>
	</tr>
	</table>
	<!-- End of wrapper table -->




</body>
</html>
