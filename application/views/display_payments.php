<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
echo $this->session->userdata('user_id');
?>

<section data-title="display_payments">
  <div class="w3-content">
    <div>
      <form  id="search_bar" action="<?php echo site_url('display_payments/search/payments/payments_model/search_payments/display_payments'); ?>" method="post" style="float: right">
        <span class="w3-twothird" style="float: right"><input id="search-field" type="search" name="search" value="Search ID, last name or reference" style="width:70%">
          <input type="submit" name="Search" value="Search" style="float: right; width:75px"></span>
      </form>  <br/><br/>       
      <table id="payments-table" name="payments_table" class="sortable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Reference</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Miscellaneous</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($payments as $payment): ?>
          <tr class="not_selected">   
            <td><?php echo $payment['payment_id']; ?></td>
            <td><?php echo $payment['customer_surname']; ?></td>
            <td><?php echo $payment['reference']; ?></td>
            <td><?php echo $payment['amount']; ?></td>
            <td><?php echo $payment['status']; ?></td>
            <td><?php echo $payment['miscellaneous']; ?></td>
          </tr>  



        <?php endforeach; ?>  
        </tbody>

      </table>
      <br/>
      <div style="width:100%; background-color:red">     
        <form style="width:auto; float:right; margin-right:2px" method="post" action="" id="delete-payment">
          <input id="hidden-delete" name="hidden_delete" type="hidden"/>
<!--          <button type="submit" id="btn-delete" name="btn_delete" class="enableOnCustomerSelect" disabled>Delete</button>-->
        </form>  
        <button id="btn-delete" name="btn_delete" class="enableOnCustomerSelect" style="width:auto; float:right" disabled>Delete</button>
      </div>       
    </div>
  </div>
  
   <div id="delete-confirm-modal" class="w3-modal">
      <div class="w3-modal-content" style="width:300px">
			 <div class="w3-container" style="width:300px">
				 <span id="close-delete-modal" class="w3-closebtn">&times;</span>
			 	 <p id="confirm-delete">Are you sure you want to delete this payment?<br/><br/>This action cannot be reversed.</p>
         <div><button id="delete-yes" class="btn_cancel">Yes</button> | <button id="delete-no" class="btn_cancel">No</button></div>
			 </div>
		</div>
  </div>  
</section>  

<!--
<script>
  $('#payments-table tr').click(function(){
    console.log(this.rowIndex);
    $(this).remove();
  });
</script>
-->

<!--
<script>
  $("#payments-table tr").click(function(){
    $(this).removeClass('not_selected').siblings().addClass('not_selected');  
    $(this).addClass('selected').siblings().removeClass('selected');    
    var value = $(this).find('td:first').html();
    console.log(value);    
    
    $('#hidden-delete').val(value);
    
    $('.enableOnCustomerSelect').prop('disabled', false);
  });
</script>
-->

<!--
<script>
  $('#search-field').focus(function(){
    if ($('#search-field').val() == 'Search ID, last name or reference'){
      $('#search-field').val('');
    }
  });
</script>
-->

<script>
  $('#delete-payment').click(function(){
    $.post('https://jkamradcliffe.net/vmssecurepay/index.php/display_payments/delete_payment', $("#delete-payment").serialize());
  });


</script>
