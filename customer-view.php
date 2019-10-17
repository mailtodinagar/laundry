<?php
include('header.php');
?>
<div class="section section-data-tables">
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Customer View</h4>
          <div class="row">
            <div class="col s12">
              <div id="page-length-option_wrapper" class="dataTables_wrapper"><table id="page-length-option" class="display dataTable dtr-inline collapsed" role="grid" style="width:100%;">
                <thead>
                  <tr role="row">
				  <th class="sorting_asc" aria-sort="ascending">Customer Id</th>
				  <th class="sorting">Name</th>
				  <th class="sorting">Email</th>
				  <th class="sorting">Contact</th>
				  <th class="sorting">Type</th>
				  
				  <th class="sorting">Action</th></tr>
                </thead>
                <tbody>
				<?php
				$url="http://www.softwaredemosite.in/api/fetch_all_customer.php";			
				//$url="http://localhost/laundry/api/fetch_all_customer.php";
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

					// Will dump a beauty json :3
					$s=json_decode($result, true);
					foreach($s as $item)
					{
						?>
						<tr role="row" class="odd">
                    <td tabindex="0" class="sorting_1"><?php echo $item['customer_id'];?></td>
					 <td><?php echo $item['cus_first_name'];?></td>
                    <td><?php echo $item['cus_email'];?></td>
                    <td><?php echo $item['cus_contact'];?></td>
                    <td><?php echo $item['cus_type'];?></td>                   
                   
					<td><a class="waves-effect waves-light btn-small mb-1 btnEdit" id="<?php echo $item["customer_id"];?>">View/Edit</a></td>
					
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
  <!-- Modal Trigger -->
  <!--<a class="waves-effect waves-light btn modal-trigger" href="#modal1" id="">Modal</a>-->
  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
  <form method="post" id="customeredit">
  <div class="modal-header" style="text-align:center;">
  <h5>Customer View/Edit</h5>
  </div>
    <div class="modal-content">      
       <div class="input-field col s6">
	   <input type="hidden" id="id" name="id">
          <input id="customer_id" type="text" name="customer_id" class="" readonly required>
          <label for="customer_id">Customer Id</label>
      </div>
	   <div class="input-field col s6">
          <input id="cus_first_name" type="text" name="cus_first_name" class="" required>
          <label for="cus_first_name">Customer First Name</label>
      </div>
	  <div class="input-field col s6">
          <input id="cus_last_name" type="text" name="cus_last_name" class="">
          <label for="cus_last_name">Last Name</label>
        </div>
        <div class="input-field col s6">
          <input id="cus_email" type="email" name="cus_email" class="" required>
          <label for="cus_email">Email</label>
      </div>
	          <div class="input-field col s6">
          <input id="cus_contact" type="text" name="cus_contact" class="" required>
          <label for="cus_contact">Mobile No<span style="color:red">*</span></label>
        </div>
<div class="input-field col s6">
 <select name="cus_gender" id="cus_gender">      
     <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="shemale">Shemale</option>
    </select>
    <label>Gender</label>
</div>
	          <div class="input-field col s6">
           <select name="cus_type" id="cus_type" required>     
      <option value="individual">Individual</option>
      <option value="organization">Organization</option>
      <option value="other">Other</option>
    </select>
    <label>Customer Type</label>
      </div>
	   <div class="input-field col s6">
          <input id="wallet_amt" type="text" class="" name="wallet_amt" required>
          <label for="wallet_amt">Wallet Amount</label>
        </div>	
		 <div class=" form-group input-field col s6">
            <input type="text" id="cus_address" name="cus_address" class="materialize-textarea"/>
          <label for="cus_address">Address</label>
        </div>
		 <div class="input-field col s6">
           <select name="status" id="status" required>     
      <option value="active">Active</option>
      <option value="inactive">Inactive</option>     
    </select>
    <label>Status</label>
      </div>
		 <!--<div class="input-field col s6">
          <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" name="fuImg" type="text">
      </div>
    </div>
        </div>-->
    </div>
	
    <div class="modal-footer">
	  <a href="#!" id="btnCancel" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan modal-close">Cancel</a>
	  <a href="#!" id="btnDelete" class="waves-effect waves-light btn gradient-45deg-red-pink">Delete</a>
	  <button type="submit" id="btnUpdate" class="waves-effect waves-light btn gradient-45deg-green-teal">Update</button>
    </div>
	</form>
  </div>
  
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
	$('a.btnEdit').click(function() { 
    var id = $(this).attr('id');   		
			$.ajax({
			url:"api/fetch_single_customer.php?id="+id,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{					
				$('#customer_id').siblings('label').addClass('active');			
				$('#customer_id').val(data['customer_id']);
				$('#id').val(data['id']);
				$('#cus_first_name').siblings('label').addClass('active');
				$('#cus_first_name').val(data['cus_first_name']);
				$('#cus_last_name').siblings('label').addClass('active');			
				$('#cus_last_name').val(data['cus_last_name']);
				$('#cus_email').siblings('label').addClass('active');
				$('#cus_email').val(data['cus_email']);				
				$('#cus_contact').siblings('label').addClass('active');			
				$('#cus_contact').val(data['cus_contact']);
				$('#wallet_amt').siblings('label').addClass('active');
				$('#wallet_amt').val(data['wallet_amt']);
				$('#cus_address').siblings('label').addClass('active');			
				$('#cus_address').val(data['cus_address']);
				 $('#cus_gender').prepend("<option selected value="+data['cus_gender']+">"+data['cus_gender']+"</option>")
				$('#cus_gender').formSelect();
				 $('#cus_type').prepend("<option selected value="+data['cus_type']+">"+data['cus_type']+"</option>")
				$('#cus_type').formSelect();	
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
	
	 	$('#customeredit').on('submit', function(event){			
		event.preventDefault();		
		if($('#cus_first_name').val() == '')
		{
			alert("Enter First Name");
		}
		else if($('#cus_last_name').val() == '')
		{
			alert("Enter Last Name");
		}
		else
		{				
			const json = serialize_form(this);		
			$.ajax({
				url: "api/update_customer.php",
				method: "POST",
				contentType: 'application/json',
				data: json,
				success:function(data)
				{									
					$('#modal1').modal('close');
					location.reload(true);
					alert('Customer Update Success');					
				},
				error: function(xhr, resp, text){
					 alert('Update Failed');	
				 }
			});
		}
	});

const serialize_form = form => JSON.stringify(
  Array.from(new FormData(form).entries())
       .reduce((m, [ key, value ]) => Object.assign(m, { [key]: value }), {})
);
	</script>

<?php include('footer.php');?>