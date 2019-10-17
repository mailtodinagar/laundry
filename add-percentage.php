<?php
include('header.php');
?>
<div class="row">
    <form class="col s12" method="post"  id="create_percentage">
	<h4>Add Percentage</h4>
      <div class="row">
	   <div class="input-field col s6">
           <div class="select-wrapper">
		   <select name="process_type" required>
		   <option value="" disabled="" selected="">Select Type</option>	   
      <option value="urgent">Urgent</option>
	  <option value="express">Express</option>
      <option value="others">Others</option>
    </select></div>
    <label>Process Type</label>
      </div>
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" name="inc_percentage" >
          <label for="first_name">Percentage <span style="color:red">*</span></label>
      </div>

      </div>
	  
       <div class="row">
	       
        <div class="input-field col s12">
          <input id="email" type="text" class="validate" name="small_desc" required>
          <label for="email">Description</label>
      </div>
     
      </div>     
	  
	 
     
      <div class="row">
        <div class="col s12 mybtn">
         <button type="submit" name="btnSave" class="waves-effect waves-light btn gradient-45deg-red-pink  border-round z-depth-4 mr-1 mb-2" href="#">Save</button>
		 <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round z-depth-4 mr-1 mb-2" href="#">Cancel</a>
        </div>
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
		 <!---------------------------Signup Start------------------------------------------->
$(document).ready(function(){
$(document).on('submit', '#create_percentage', function(){
    // get form 	

    var create_percentage = $(this);	
    var form_data = JSON.stringify(create_percentage.serializeObject());
    // submit form data to api
    $.ajax({		
        url: "api/create_percentage.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,		
        success : function(result) {
            // if response is a success, tell the user it was a successful sign up & empty the input boxes
            //$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
			alert(result.message);			
            //create_customer.find('input').val('');
        },
        error: function(xhr, resp, text){
            // on error, tell the user sign up failed
			alert('Data Saved Failed');		
            //response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
        }
    });

    return false;
});
$.fn.serializeObject = function(){
 
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
});
 
 <!---------------------------Signup end------------------------------------------->
	</script>
<?php include('footer.php');?>