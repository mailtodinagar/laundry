<?php
include('header.php');
?>
<div class="section section-data-tables">
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Region View</h4>
          <div class="row">
            <div class="col s12">
              <div id="page-length-option_wrapper" class="dataTables_wrapper"><table id="page-length-option" class="display dataTable dtr-inline collapsed" role="grid" aria-describedby="page-length-option_info" style="width: 1153px;">
                <thead>
                  <tr role="row">
				  <th class="sorting_asc">Shop Name</th>
				  <th class="sorting">Country</th>
				  <th class="sorting">Tax No</th>
				  <th class="sorting">Tax Percentage</th>
				  <th class="sorting">Status</th>
				  <th>Action</th></tr>
                </thead>
                <tbody>
				<?php
				$url="http://www.softwaredemosite.in/api/fetch_all_shop.php";				
				//$url="http://localhost/laundry/api/fetch_all_shop.php";
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
                    <td tabindex="0" class="sorting_1"><?php echo $item['shop_name'];?></td>
					 <td><?php echo $item['shop_country'];?></td>
                    <td><?php echo $item['tax_no'];?></td>
                    <td><?php echo $item['tax_percentage'];?></td>
                    <td><?php echo $item['status'];?></td>                    
                     <td><a class="waves-effect waves-light btn-small mb-1 btnEdit" id="<?php echo $item["id"];?>">View/Edit</a></td>
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
  <form method="post" id="shopedit">
  <div class="modal-header" style="text-align:center;">
  <h5>Shop View/Edit</h5>
  </div>
    <div class="modal-content">      
        <div class="input-field col s6">
		<input type="hidden" name="id" id="id">
          <input id="shop_name" name="shop_name" type="text" class="validate" required>
          <label for="shop_name">Shop Name</label>
      </div>
	   <div class="input-field col s6">
           <select name="shop_country" id="shop_country" required>     
      <option value="india">India</option>
      <option value="uk">UK</option>
      <option value="usa">USA</option>
    </select>
    <label>Country</label>
      </div>
        <div class="input-field col s6">
          <input id="tax_no" name="tax_no" type="text" class="validate" required>
          <label for="tax_no">Tax Number</label>
        </div>
		 <div class="input-field col s6">
          <input id="tax_percentage" name="tax_percentage" type="text" class="validate" required>
          <label for="tax_percentage">Tax Percentage</label>
        </div>	
	          <div class="input-field col s6">
           <textarea id="shop_desc" name="shop_desc" class="materialize-textarea"></textarea>
          <label for="shop_desc">Description</label>
        </div>
 <div class="input-field col s12">
           <textarea id="shop_address" name="shop_address" class="materialize-textarea" required></textarea>
          <label for="shop_address">Shop Address</label>
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
			url:"api/fetch_single_shop.php?id="+id,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{					
				$('#shop_name').siblings('label').addClass('active');			
				$('#shop_name').val(data['shop_name']);
				$('#id').val(data['id']);
				$('#tax_no').siblings('label').addClass('active');
				$('#tax_no').val(data['tax_no']);
				$('#tax_percentage').siblings('label').addClass('active');			
				$('#tax_percentage').val(data['tax_percentage']);
				$('#shop_desc').siblings('label').addClass('active');
				$('#shop_desc').val(data['shop_desc']);				
				$('#shop_address').siblings('label').addClass('active');			
				$('#shop_address').val(data['shop_address']);				
				 $('#shop_country').prepend("<option selected value="+data['shop_country']+">"+data['shop_country']+"</option>")
				$('#shop_country').formSelect();	
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
				url: "api/delete_shop.php?id="+cusid,
				method: "POST",
				contentType: 'application/json',
				//data: {id:cusid},
				success:function(data)
				{				
					$('#modal1').modal('close');
					location.reload(true);
					alert('Shop Delete Success');					
				},
				error: function(xhr, resp, text){					
					 alert('Shop Delete Failed');	
				 }
			});
		}
		else
		{
		return false
		}
	});
	
	 	$('#shopedit').on('submit', function(event){			
		event.preventDefault();		
		if($('#shop_name').val() == '')
		{
			alert("Enter Shop Name");
		}
		else if($('#tax_no').val() == '')
		{
			alert("Enter Tax No");
		}
		else
		{				
			const json = serialize_form(this);		
			$.ajax({
				url: "api/update_shop.php",
				method: "POST",
				contentType: 'application/json',
				data: json,
				success:function(data)
				{									
					$('#modal1').modal('close');
					location.reload(true);
					alert('Shop Update Success');					
				},
				error: function(xhr, resp, text){
					 alert(' Shop Update Failed');	
				 }
			});
		}
	});

const serialize_form = form => JSON.stringify(
  Array.from(new FormData(form).entries())
       .reduce((m, [ key, value ]) => Object.assign(m, { [key]: value }), {})
);
	</script>
    <!-- END: Page Main-->
<?php include('footer.php');?>