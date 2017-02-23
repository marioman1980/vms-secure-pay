// Ajax request passing User form values to php   

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
                
                $('#email_sent').show();
                //document.getElementById('email_sent').style.display='block';

                //form.find('#submit').prop('disabled', true);                
              }		
				    });
				    return false;
			   });
		  });				
