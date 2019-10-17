<?php
include('header.php');
?>
<div class="section section-data-tables">
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Staff View</h4>
          <div class="row">
            <div class="col s12">
              <div id="page-length-option_wrapper" class="dataTables_wrapper"><table id="page-length-option" class="display dataTable dtr-inline collapsed" role="grid" aria-describedby="page-length-option_info" style="width: 1153px;">
                <thead>
                  <tr role="row">
				  <th class="sorting_asc">Staff Id</th>
				  <th class="sorting">Staff Name</th>
				  <th class="sorting">Permission</th>
				  <th class="sorting">Contact</th>
				  <th class="sorting">Status</th>
				  <th class="sorting">Action</th></tr>
                </thead>
                <tbody>
				<?php
				$url="http://www.softwaredemosite.in/api/fetch_all_staff.php";			
				//$url="http://localhost/laundry/api/fetch_all_staff.php";
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
                    <td tabindex="0" class="sorting_1"><?php echo $item['staff_id'];?></td>
					 <td><?php echo $item['staff_name'];?></td>
                    <td><?php echo $item['staff_permission'];?></td>
                    <td><?php echo $item['staff_phone'];?></td>
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
  <form method="post" id="staffedit">
  <div class="modal-header" style="text-align:center;">
  <h5>Staff View/Edit</h5>
  </div>
    <div class="modal-content"> 
			<div class="input-field col s6">
			<input type="hidden" id="id" name="id">
          <input id="staff_id" type="text" name="staff_id" readonly required>
          <label for="staff_id">Staff Id</label>
      </div>
		<div class="input-field col s6">
          <input id="staff_name" type="text"  name="staff_name" required>
          <label for="staff_name">Staff Name</label>
      </div>
	        <div class="input-field col s6">
          <input id="staff_surname" type="text" class="validate" name="staff_surname" required>
          <label for="staff_surname">Surname</label>
        </div>		      
		 <div class="input-field col s6">
          <input id="staff_username" type="text" class="validate" name="staff_username" required>
          <label for="staff_username">User Name</label>
        </div>
		        <div class="input-field col s6">
          <input id="staff_password" type="text" class="validate" name="staff_password" required>
          <label for="staff_password">staff_password</label>
        </div>
		        <div class="input-field col s6">
          <input id="staff_email" type="text" class="validate" name="staff_email" required>
          <label for="staff_email">E-Mail</label>
        </div>
		        <div class="input-field col s6">
          <input id="staff_phone" type="text" class="validate" name="staff_phone" required>
          <label for="staff_phone">staff_phone No</label>
        </div>
		        <div class="input-field col s6">
          <input id="staff_dob" type="date" class="validate" name="staff_dob" required>
          <label for="staff_dob">staff_dob</label>
        </div>
		<div class="input-field col s6">
          <input id="staff_doj" type="date" class="validate" name="staff_doj" required>
          <label for="staff_doj">staff_doj</label>
        </div>

	<div class="input-field col s12">
           <div class="select-wrapper">
		   <select name="staff_permission" id="staff_permission" required>		  
      <option value="all">All</option>
	  <option value="add">Add</option>
      <option value="edit">Edit</option>
	  <option value="view">View</option>
      <option value="delete">Delete</option>
    </select></div>
    <label>Staff Permission</label>
      </div>
		        <div class="input-field col s12">
          <input id="staff_address" type="text" name="staff_staff_address" class="validate" required>
          <label for="staff_address">staff_address</label>
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
			url:"api/fetch_single_staff.php?id="+id,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{		
				$('#staff_id').siblings('label').addClass('active');			
				$('#staff_id').val(data['staff_id']);
				$('#id').val(data['id']);
				$('#staff_name').siblings('label').addClass('active');
				$('#staff_name').val(data['staff_name']);
				$('#staff_surname').siblings('label').addClass('active');			
				$('#staff_surname').val(data['staff_surname']);
				$('#staff_username').siblings('label').addClass('active');
				$('#staff_username').val(data['staff_username']);				
				//$('#staff_password').siblings('label').addClass('active');			
				//$('#staff_password').val(data['staff_password']);
				$('#staff_email').siblings('label').addClass('active');
				$('#staff_email').val(data['staff_email']);
				$('#staff_phone').siblings('label').addClass('active');			
				$('#staff_phone').val(data['staff_phone']);
				$('#staff_dob').siblings('label').addClass('active');
				$('#staff_dob').val(data['staff_dob']);
				$('#staff_doj').siblings('label').addClass('active');			
				$('#staff_doj').val(data['staff_doj']);	
				$('#staff_address').siblings('label').addClass('active');			
				$('#staff_address').val(data['staff_address']);
				 $('#staff_permission').prepend("<option selected value="+data['staff_permission']+">"+data['staff_permission']+"</option>")
				$('#staff_permission').formSelect();		
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
				url: "api/delete_staff.php?id="+cusid,
				method: "POST",
				contentType: 'application/json',
				//data: {id:cusid},
				success:function(data)
				{				
					$('#modal1').modal('close');
					location.reload(true);
					alert('Staff Delete Success');					
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
	
	 	$('#staffedit').on('submit', function(event){			
		event.preventDefault();		
		if($('#staff_name').val() == '')
		{
			alert("Enter Name");
		}
		else if($('#staff_username').val() == '')
		{
			alert("Enter User Name");
		}
		else
		{				
			const json = serialize_form(this);			
			$.ajax({
				url: "api/update_staff.php",
				method: "POST",
				contentType: 'application/json',
				data: json,
				success:function(data)
				{									
					$('#modal1').modal('close');
					location.reload(true);
					alert('Staff Update Success');					
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