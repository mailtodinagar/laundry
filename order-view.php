<?php
include('header.php');
?>
<div class="section section-data-tables">
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Order View</h4>
          <div class="row">
            <div class="col s12">
              <div id="page-length-option_wrapper" class="dataTables_wrapper"><table id="page-length-option" class="display dataTable dtr-inline collapsed" role="grid" aria-describedby="page-length-option_info" style="width:100%;">
                <thead>
                  <tr role="row">
				  <th class="sorting_asc">Order Id</th>
				  <th>Customer Id</th>
				  <th>Order Type</th>
				  
				  <th>Total Qty</th>
				  <th>Status</th>
				  <th>Action</th></tr>
                </thead>
				 <tbody>
					<?php
				//$url="http://www.softwaredemosite.in/api/fetch_all_orders.php";
				$url="http://localhost/laundry/api/fetch_all_orders.php";
					//  Initiate curl
					$ch = curl_init();
					// Will return the response, if false it print the response
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// Set the url
					curl_setopt($ch, CURLOPT_URL,$url);
					// Execute
					$result=curl_exec($ch);
					// Closing
					curl_close($ch);
					$count=1;
					// Will dump a beauty json :3
					$s=json_decode($result, true);
					foreach($s as $item)
					{
						?>					
						<tr role="row" class="odd">
                    <td class="sorting_1"><a href="#!" class="modal-trigger btnLstview" id="<?php echo $item['order_id'];?>"><?php echo $item['order_id'];?></a></td>
					<td style=""><?php echo $item['customer_id'];?></td>
					<td><?php echo $item['process_type'];?></td>
                    <td><?php echo $item['total_qty'];?></td>                   
                    <td><?php echo $item['status'];?></td>                    
                    <td><a class="waves-effect waves-light btn-small mb-1 btnEdit" id="<?php echo $item['id'];?>">View/Edit</a></td>
                  </tr>
					<?php
                  				
					}
				?>
				  </tbody>              
              </table>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<!-- END RIGHT SIDEBAR NAV -->
<!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
  <form method="post" id="orderedit">
  <div class="modal-header" style="text-align:center;">
  <h5>Order View/Edit</h5>
  </div>

    <div class="modal-content"> 
 <div class="input-field col s6">
	   <input type="hidden" id="id" name="id">
          <input id="order_id" type="text" name="order_id" class="" readonly required>
          <label for="order_id">Order Id</label>
      </div>	
       <div class="input-field col s6">	  
          <input id="customer_id" type="text" name="customer_id" class="" readonly required>
          <label for="customer_id">Customer Id</label>
      </div>
	   <div class="input-field col s6">
          <input id="customer_name" type="text" name="customer_name" class="" readonly required>
          <label for="customer_name">Customer Name</label>
      </div>
	  <div class="input-field col s6">
          <input id="customer_contact" type="text" name="customer_contact" readonly class="">
          <label for="customer_contact">Customer Contact</label>
        </div>
        <div class="input-field col s6">
          <input id="process_type" type="text" name="process_type" class="" readonly required>
          <label for="process_type">Process Type</label>
      </div>
	          <div class="input-field col s6">
          <input id="tax_percentage" type="text" name="tax_percentage" class="" readonly required>
          <label for="tax_percentage">Tax Percentage<span style="color:red">*</span></label>
        </div>
		 <div class="input-field col s6">
          <input id="tax_amount" type="text" name="tax_amount" class="" readonly required>
          <label for="tax_amount">Tax Amount<span style="color:red">*</span></label>
        </div>
		 <div class="input-field col s6">
          <input id="discount_percentage" type="text" name="discount_percentage" class="" readonly required>
          <label for="discount_percentage">Discount Percentage<span style="color:red">*</span></label>
        </div>
		 <div class="input-field col s6">
          <input id="discount_amount" type="text" name="discount_amount" class="" readonly required>
          <label for="discount_amount">Discount Amount<span style="color:red">*</span></label>
        </div>

	   <div class="input-field col s6">
          <input id="total_qty" type="text" class="" name="total_qty" readonly required>
          <label for="total_qty">Total Qty</label>
        </div>	
		 <div class=" form-group input-field col s6">
            <input type="text" id="net_amount" name="net_amount" readonly class=""/>
          <label for="net_amount">Net Amount</label>
        </div>
		 <div class=" form-group input-field col s6">
            <input type="text" id="payable_amount" name="payable_amount" readonly class=""/>
          <label for="payable_amount">Paid Amount</label>
        </div>
		 <div class="input-field col s6">
           <select name="status" id="status" required>     
      <option value="booked">Booked</option>
      <option value="process">Process</option>  
		<option value="delivered">Delivered</option>  	  
    </select>
    <label>Status</label>
      </div>
		
    </div>
	
    <div class="modal-footer">
	  <a href="#!" id="btnCancel" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan modal-close">Cancel</a>
	  <a href="#!" id="btnDelete" class="waves-effect waves-light btn gradient-45deg-red-pink">Delete</a>
	  <button type="submit" id="btnUpdate" class="waves-effect waves-light btn gradient-45deg-green-teal">Update</button>
    </div>
	</form>
  </div>
  
  <!--order list model-->
    <div id="listmodel" class="modal modal-fixed-footer">
  <form method="post" id="customeredit">
  <div class="modal-header" style="text-align:center;">
  <h5>OrderList View</h5>
  </div>
    <div class="modal-content"> 
	<div class="input-field col s12">
	<table id="table_data">
	<thead>
	<tr>
		<th>
		Order_id
		</th>
		<th>
		Product Name
		</th>
		<th>
		Process Type
		</th>
		<th>
		Unit Cost
		</th>
		<th>
		Qty
		</th>
		<th>
		Total
		</th>
		<tr>
	</thead>
	<tbody>
	</tbody>
	</table>
	</div>
    </div>
    <div class="modal-footer">
	  <a href="#!" id="btnCancel" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan modal-close">Close</a>
    </div>
	</form>
  </div>
  <!--order list end-->
<!-- END RIGHT SIDEBAR NAV -->

          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
	

	<script>
	
 $(document).ready(function() {
    $('select').material_select();
 });
 
 $('a.btnLstview').click(function() {
    var id = $(this).attr('id');   		
			$.ajax({
			url:"api/fetch_single_orderlist.php?id="+id,
			method:"GET",
			//data:{id:fullname},
			dataType:"json",      
        success: function(data){
			$('#table_data tbody').empty();
            /*console.log(data);*/
            var event_data = '';
            $.each(data, function(index, value){
                /*console.log(value);*/
                event_data += '<tr>';
                event_data += '<td>'+value.order_id+'</td>';
                event_data += '<td>'+value.product_name+'</td>';
				 event_data += '<td>'+value.process_type+'</td>';
                event_data += '<td>'+value.unit_cost+'</td>';
				 event_data += '<td>'+value.product_qty+'</td>';
                event_data += '<td>'+value.total+'</td>';
                event_data += '</tr>';
            });
            $("#table_data").append(event_data);
			$('#listmodel').modal('open');	
        },
        error: function(d){
            /*console.log("error");*/
            alert("404. Please wait until the File is Loaded.");
        }		
		});
    return false; 	 
    //if(data.first_name)
    //{
    
   // }
 });
	$('a.btnEdit').click(function() { 
    var id = $(this).attr('id');   		
			$.ajax({
			url:"api/fetch_single_order.php?id="+id,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{					
				$('#order_id').siblings('label').addClass('active');			
				$('#order_id').val(data['order_id']);
				$('#id').val(data['id']);
				$('#customer_id').siblings('label').addClass('active');			
				$('#customer_id').val(data['customer_id']);
				$('#customer_name').siblings('label').addClass('active');
				$('#customer_name').val(data['customer_name']);
				$('#customer_contact').siblings('label').addClass('active');			
				$('#customer_contact').val(data['customer_contact']);
				$('#process_type').siblings('label').addClass('active');
				$('#process_type').val(data['process_type']);				
				$('#tax_percentage').siblings('label').addClass('active');			
				$('#tax_percentage').val(data['tax_percentage']);
				$('#tax_amount').siblings('label').addClass('active');
				$('#tax_amount').val(data['tax_amount']);
				$('#discount_percentage').siblings('label').addClass('active');			
				$('#discount_percentage').val(data['discount_percentage']);
				$('#discount_amount').siblings('label').addClass('active');
				$('#discount_amount').val(data['discount_amount']);
				$('#total_qty').siblings('label').addClass('active');			
				$('#total_qty').val(data['total_qty']);
				$('#net_amount').siblings('label').addClass('active');
				$('#net_amount').val(data['net_amount']);
				$('#payable_amount').siblings('label').addClass('active');			
				$('#payable_amount').val(data['payable_amount']);
	
				 $('#status').prepend("<option selected value="+data['status']+">"+data['status']+"</option>")
				$('#status').formSelect();	
				$('#modal1').modal('open');				
			}			
		});
    return false; 
});
	$('#btnDelete').click(function(){
		var cusid = $('#id').val();
		if(confirm('Are you Sure Delete this One?'))
		{
				$.ajax({
				url: "api/delete_customer.php?id="+cusid,
				method: "POST",
				contentType: 'application/json',
				//data: {id:cusid},
				success:function(data)
				{				
					$('#modal1').modal('close');
					location.reload(true);
					alert('Customer Delete Success');					
				},
				error: function(xhr, resp, text){					
					 alert('Delete Failed');	
				 }
			});
		}
		else
		{
		return false
		}
	});
	
	 	$('#orderedit').on('submit', function(event){			
		event.preventDefault();
						
			const json = serialize_form(this);		
			$.ajax({
				url: "api/update_order.php",
				method: "POST",
				contentType: 'application/json',
				data: json,
				success:function(data)
				{									
					$('#modal1').modal('close');
					location.reload(true);
					alert('Order Update Success');					
				},
				error: function(xhr, resp, text){
					 alert('Update Failed');	
				 }
			});

	});

const serialize_form = form => JSON.stringify(
  Array.from(new FormData(form).entries())
       .reduce((m, [ key, value ]) => Object.assign(m, { [key]: value }), {})
);
	</script>

<?php include('footer.php');?>