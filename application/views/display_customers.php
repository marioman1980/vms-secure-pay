<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); 
echo $this->session->userdata('user_id');
?>

<section data-title="display_customers">
  <div class="w3-content">
    <div>
      <form  id="search_bar" action="<?php echo site_url('display_customers/search/customers/customer_model/search_customers/display_customers'); ?>" method="post" style="float: right">
        <span class="w3-twothird" style="float: right"><input id="search-field" type="search" name="search"  value="Search ID or last name" style="width:70%">
          <input type="submit" name="Search" value="Search" style="float: right; width:75px"></span>
      </form>  <br/><br/>         
      <table id="customer-table" name="customer_table" class="sortable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
          <tr class="not_selected">   
            <td><?php echo $customer['customer_id']; ?></td>
            <td><?php echo $customer['title']; ?></td>
            <td><?php echo $customer['customer_forename']; ?></td>
            <td><?php echo $customer['customer_surname']; ?></td>
            <td><?php echo $customer['email']; ?></td>
          </tr>  



        <?php endforeach; ?>  
        </tbody>

      </table>
      <br/>
      <div style="width:100%; background-color:red">
        <form style="width:auto; float:left; margin-right:2px" method="post" action="https://jkamradcliffe.net/vmssecurepay/index.php/main/populate_from_db"><button type="submit" id="btn-request-payment" name="btn-request-payment" class="enableOnCustomerSelect" disabled>Request Payment</button></form> 
        <form style="width:auto; float:left; margin-left:2px" method="post" action="https://jkamradcliffe.net/vmssecurepay/index.php/add_customer/edit_customer"><button type="submit" id="btn-edit-details" name="btn-edit-details" class="enableOnCustomerSelect" disabled>Edit Details</button></form>       
        <form style="width:auto; float:right; margin-right:2px" method="post" action="" id="delete-customer">
          <input id="hidden-delete" name="hidden_delete" type="hidden"/>
        </form>            
        <button id="btn-delete" name="btn_delete" class="enableOnCustomerSelect" style="width:auto; float:right" disabled>Delete</button>
      </div>     
    </div>
  </div>
  
   <div id="delete-confirm-modal" class="w3-modal">
      <div class="w3-modal-content" style="width:300px">
			 <div class="w3-container" style="width:300px">
				 <span id="close-delete-modal" class="w3-closebtn">&times;</span>
			 	 <p id="confirm-delete">Are you sure you want to delete this customer? <br/><br/>All customer details and associated payments will be lost.<br/><br/>This action cannot be reversed.</p>
         <div><button id="delete-yes" class="btn_cancel">Yes</button> | <button id="delete-no" class="btn_cancel">No</button></div>
			 </div>
		</div>
  </div>    
</section>  

<!--
<script>
  $("#customer-table tr").click(function(){
    $(this).removeClass('not_selected').siblings().addClass('not_selected');  
    $(this).addClass('selected').siblings().removeClass('selected');    
    var value = $(this).find('td:first').html();
    console.log(value);    
    
    $('#btn-request-payment').val(value);
    $('#btn-edit-details').val(value);
    $('#hidden-delete').val(value);
    
    $('.enableOnCustomerSelect').prop('disabled', false);
  });
</script>
-->

<!--
<script>
  $('#search-field').focus(function(){
    if ($('#search-field').val() == 'Search ID or last name'){
      $('#search-field').val('');
    }
  });
</script>
-->

<script>
  $('#delete-customer').click(function(){
    $.post('https://jkamradcliffe.net/vmssecurepay/index.php/display_customers/delete_customer', $("#delete-customer").serialize());
  });

</script>
  
  








