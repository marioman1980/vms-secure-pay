
function removePlaceholderText(txtInput, placeholderText){
  $(txtInput).focus(function(){
    if ($(txtInput).val() == placeholderText){
      $(txtInput).val('');
      $(txtInput).css('color', '#000000');
    }
  });  
} 
var rowIndex;
function getSelectedRow(tableId){
  $(tableId + " tr").click(function(){
    $(this).removeClass('not_selected').siblings().addClass('not_selected');  
    $(this).addClass('selected').siblings().removeClass('selected');    
    var value = $(this).find('td:first').html();
    rowIndex = this.rowIndex;
    console.log(value);    
    console.log(rowIndex);
    
    $('#btn-request-payment').val(value);
    $('#btn-edit-details').val(value);
    $('#hidden-delete').val(value);
    
    $('.enableOnCustomerSelect').prop('disabled', false);
  });
}

function searchRecords(placeholder){
  $('#search-field').focus(function(){
    if ($('#search-field').val() == placeholder){
      $('#search-field').val('');
    }
  });
}

function clearForm(formId){
  $('#cancel').click(function(){
    $('#reset_form').show();
  });
  
  $('#cancel-yes').click(function(){
    $(formId).trigger("reset");
    $('#reset_form').hide();
  });
   $('#cancel-no').click(function(){
      $('#reset_form').hide();
   });	  
  
   $('#close-reset-modal').click(function(){
      $('#reset_form').hide();
   });	   
}

function deleteConfirm(formId){
  $('#btn-delete').click(function(){
    $('#delete-confirm-modal').show();
  });  
  $('#delete-yes').click(function(){
    $(formId).click();
    $('#delete-confirm-modal').hide();
  });
  $('#delete-no').click(function(){
    $('#delete-confirm-modal').hide();
  });	  

  $('#close-delete-modal').click(function(){
    $('#delete-confirm-modal').hide();
  });  
}

/* ========================== Login ============================
================================================================= */
if ($('section').data('title') === 'login'){
  /* Submit login details for verification */
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
}


/* ========================== Register ============================
================================================================= */
if ($('section').data('title') === 'register'){
  /* Register user and return to login screen */
  $(document).ready(function(){
    $(document).on('submit', '#register', function(){	
      event.preventDefault();
      /* Prevent submission if passwords don't match */
      if ($('#password').val() != $('#confirm-password').val()) {
        $('#pass-match').html('<p>Passwords don\'t match</p>').css('color', 'red');
      }
      else{
        var form = $('#register');
        //var data_string = $(form).serialize();
        var data_string = new FormData(this);	
        $.ajax({
          type: 'POST',
          url: 'https://jkamradcliffe.net/vmssecurepay/index.php/login/user_registration',
          data: data_string,
          contentType: false,
          processData: false,
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
            console.log(obj.filename);
          }		
        });        
      }
      return false;
    });
  });	
  
  /* Check passwords match */
  $('#password, #confirm-password').on('keyup', function () {
    if ($('#password').val() == $('#confirm-password').val()) {
      $('#pass-match').html('<p>Passwords match</p>').css('color', 'green');
    } else 
      $('#pass-match').html('<p>Passwords don\'t match</p>').css('color', 'red');
  }); 
  
  /* If accessed when user is logged in, make delete account option available */
  $(document).ready(function(){
    if (localStorage.getItem('enableBtnDeleteAccount') == 'true'){
      $('#btn-delete').removeAttr('hidden');
    }
  }); 
  
  clearForm('#register');
  deleteConfirm('#delete-account');
}

/* ========================== Add Customer ============================
================================================================= */
if ($('section').data('title') === 'add_customer'){
  
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
            $('#form-success-msg').html('Customer added/updated');
            $('#form-success').show();
            console.log("Success");
          }
          else{
            console.log("No success");
            $('#form-success-msg').html('There are errors in the form');
            $('#form-success').show();
            $('#form-errors').html(obj.error); 
          }
        }		
      });
      return false;
    });
  });	  
  
  /* Clear Form */
  clearForm('#add_update_customer');
}

/* ========================== Display Customers ============================
================================================================= */
if ($('section').data('title') === 'display_customers'){
  getSelectedRow("#customer-table");

  searchRecords('Search ID or last name');

//  $('#btn-delete').click(function(){
//    $.post('https://jkamradcliffe.net/vmssecurepay/index.php/display_customers/delete_customer', $("#delete-customer").serialize());
//    $('#customer-table tr:eq(' + rowIndex + ')').remove();
//  }); 
  
  deleteConfirm('#delete-customer');
}

/* ============================ Payment Request ===========================
============================================================================ */
if ($('section').data('title') === 'payment_request'){
  /* AJAX passing details to send email and return response */
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
            if (obj.success == true){
              $('#email_sent_alert').html('Request for payment sent <br/><br/> \
                                            You can view the status of your payments <a href="../display_payments">here</a>');
              $('#email_sent').show();
              form.find('#submit').prop('disabled', true);
              console.log("Success");
            }
            else{
              console.log("No success");
              $('#email_sent_alert').html('There are errors in the form');
              $('#email_sent').show();
              $('#error').html(obj.error); 
            }            

          }		
        });
        return false;
     });
  });	
  
  removePlaceholderText($('#miscellaneous'), 'For your records. Customers won\'t see this'); 
  clearForm('#details_for_email');
  
}

/* ========================== Display Payments ============================
================================================================= */
if ($('section').data('title') === 'display_payments'){
  getSelectedRow("#payments-table");
  searchRecords('Search ID, last name or reference');
  
  deleteConfirm('#delete-payment');
  
//  $('#btn-delete').click(function(){
//    $.post('https://jkamradcliffe.net/vmssecurepay/index.php/display_payments/delete_payment', $("#delete-payment").serialize());
//    $('#payments-table tr:eq(' + rowIndex + ')').remove();
//  });  
}
 
/* ========================== Payment Form ============================
================================================================= */
if ($('section').data('title') === 'payment_form'){
  function submit_for_payment(api_pk){
    /* Publishable API key */
    //var stripe = Stripe('pk_test_hf3cRYT5E8wlB3f5X6b75d4R');
    var stripe = Stripe(api_pk);
    var elements = stripe.elements();

    /* Custom styling can be passed to options when creating an Element. */
    var style = {
      base: {
        '::placeholder': {
          color: '#CFD7E0'
        }
      }
    };

    /* Create an instance of the card Element, with above styling */
    var card = elements.create('card', {style: style});

    /* Add an instance of the card Element into the `card-element` <div> */
    card.mount('#card-element');   

    /* Listen to change event and display error if invalid card details are entered */
    card.addEventListener('change', function(event) {
      if (event.error) {
        $('#card-errors').html(event.error.message);
        $('#submit_button').prop('disabled', false);
      } else {
        $('#card-errors').html('');
      }
    });  

  /*
  * The next 3 functions are concerned with tokenizing
  * Customer credit / debit card details and submitting 
  * the form. with the token, to the server
  */  

    $('#submit_button').click(function(e){
      /* Disable the submit button to prevent repeated clicks */
      $('#submit_button').prop('disabled', true);
      e.preventDefault(); /* Prevent form submission */
      /* Create token */
      stripe.createToken(card).then(function(result) {
        if (result.error) {
          /* Inform user if there's an error */
          $('#card-errors').html(result.error.message);
        } else {
          /* Insert token using hidden field so that it can be submitted */
          $('#payment_form').append($('<input type="hidden" name="stripeToken">').val(result.token.id));
          /* Get current url, to allow user to return if necessary */
          var url = window.location.href;
          $('#payment_form').append($('<input type="hidden" name="url">').val(url));
          $('#payment_form').submit();         
        }
      }); 
    });

  /* AJAX handles form submission */  
    $(document).ready(function(){
      $(document).on('submit', '#payment_form', function(){	
        event.preventDefault();
        var form = $('#payment_form');
        var data_string = $(form).serialize();	
        $.ajax({
          type: 'POST',
          url: 'https://vmssecurepay.jkamradcliffe.net/index.php/payment_form/process_payment',
          data: data_string,
          success: function(json){
            var obj = jQuery.parseJSON(json);
            if (obj.success == true){
              window.location.href = 'https://vmssecurepay.jkamradcliffe.net/index.php/payment_status'
              console.log("There are no errors in the form");
            }else{
              $('#submit_button').prop('disabled', false);
              console.log("There are errors in the form");
              $('#card-errors').html("There are errors in the form");
              $('#errors').html(obj.error); 
              console.log(obj.error);
            }

          }		
        });
        return false;
      });
    });	
  }
}

/* ========================== Contact Form ============================
================================================================= */
if ($('section').data('title') === 'contact_form'){
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
  
  clearForm('#contact_form');
}






		



