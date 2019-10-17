<?php
include('header.php');
?>
<div class="section section-data-tables">
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Percentage View</h4>
          <div class="row">
            <div class="col s12">
              <div id="page-length-option_wrapper" class="dataTables_wrapper"><table id="page-length-option" class="display dataTable dtr-inline collapsed" role="grid" aria-describedby="page-length-option_info" style="width: 100%;">
                <thead>
                  <tr role="row">
				  <th class="sorting_asc">Sno</th>
				  <th class="sorting">Process Type</th>
				  <th class="sorting">Percentage</th>
				  <th class="sorting">Description</th>
				  <th class="sorting">Status</th>
				  <th class="sorting">Action</th></tr>
                </thead>
                <tbody>
					<?php
				$url="http://www.softwaredemosite.in/api/fetch_all_percentage.php";
				//$url="http://localhost/laundry/api/fetch_all_percentage.php";
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
                    <td tabindex="0" class="sorting_1"><?php echo $count;?></td>
					<td><?php echo $item['process_type'];?></td>
					<td><?php echo $item['inc_percentage'];?></td>
                    <td><?php echo $item['small_desc'];?></td>                   
                    <td><?php echo $item['status'];?></td>                    
                    <td style="display: none;"><a class="waves-effect waves-light btn-small mb-1 btnEdit" id="<?php echo $item['id'];?>">View/Edit</a></td>
                  </tr>
					<?php
                    $count++;					
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
  <form method="post" id="percentageedit">
  <div class="modal-header" style="text-align:center;">
  <h5>Percentage View/Edit</h5>
  </div>
    <div class="modal-content">      
        <div class="input-field col s6">
		<input type="hidden" id="id" name="id">
           <div class="select-wrapper">
		   <select name="process_type" id="process_type" required>		
		<option value="ordinary">Ordinary</option>		   
      <option value="urgent">Urgent</option>
      <option value="express">Express</option>
    </select></div>
    <label>Process Type</label>
      </div>
	   <div class="input-field col s6">
          <input id="inc_percentage" type="text" class="validate" name="inc_percentage" >
          <label for="inc_percentage">Percentage <span style="color:red">*</span></label>
      </div>
	  <div class="input-field col s12">
          <input id="small_desc" type="text" class="validate" name="small_desc" required>
          <label for="small_desc">Description</label>
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
			url:"api/fetch_single_percentage_id.php?id="+id,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{					
				$('#inc_percentage').siblings('label').addClass('active');			
				$('#inc_percentage').val(data['inc_percentage']);
				$('#id').val(data['id']);
				$('#small_desc').siblings('label').addClass('active');
				$('#small_desc').val(data['small_desc']);				
				 $('#process_type').prepend("<option selected value="+data['process_type']+">"+data['process_type']+"</option>")
				$('#process_type').formSelect();				
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
				url: "api/delete_percentage.php?id="+cusid,
				method: "POST",
				contentType: 'application/json',
				//data: {id:cusid},
				success:function(data)
				{				
					$('#modal1').modal('close');
					location.reload(true);
					alert('Percentage Delete Success');					
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
	
	 	$('#percentageedit').on('submit', function(event){			
		event.preventDefault();		
		if($('#inc_percentage').val() == '')
		{
			alert("Enter Percentage");
		}	
		else
		{				
			const json = serialize_form(this);			
			$.ajax({
				url: "api/update_percentage.php",
				method: "POST",
				contentType: 'application/json',
				data: json,
				success:function(data)
				{									
					$('#modal1').modal('close');
					location.reload(true);
					alert('Percentage Update Success');					
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