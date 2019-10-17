<?php
include('header.php');
?>

<div class="row">
    <form class="col s12" method="post" id="create_staff">
	<h4>Create Staff</h4>
      <div class="row">
	  <div class="input-field col s6">
          <input id="staffid" type="text" class="validate" name="staff_id" required>
          <label for="staffid">Staff Id</label>
      </div>
        <div class="input-field col s6">
          <input id="staffname" type="text" class="validate" name="staff_name" required>
          <label for="staffname">Full Name</label>
      </div>
	        <div class="input-field col s6">
          <input id="father" type="text" class="validate" name="staff_surname" required>
          <label for="father">Surname</label>
        </div>		      
		 <div class="input-field col s6">
          <input id="username" type="text" class="validate" name="staff_username" required>
          <label for="username">User Name</label>
        </div>
		        <div class="input-field col s6">
          <input id="password" type="password" class="validate" name="staff_password" required>
          <label for="password">Password</label>
        </div>
		        <div class="input-field col s6">
          <input id="email" type="text" class="validate" name="staff_email" required>
          <label for="email">E-Mail</label>
        </div>
		        <div class="input-field col s6">
          <input id="mobile" type="text" class="validate" name="staff_phone" required>
          <label for="mobile">Mobile No</label>
        </div>
		        <div class="input-field col s6">
          <input id="dob" type="date" class="validate" name="staff_dob" required>
          <label for="dob">DOB</label>
        </div>
		<div class="input-field col s6">
          <input id="doj" type="date" class="validate" name="staff_doj" required>
          <label for="doj">DOJ</label>
        </div>
		
			 
	<div class="input-field col s12">
           <div class="select-wrapper">
		   <select name="staff_permission" required>
		   <option value="" disabled="" selected="">Select Permission</option>
      <option value="all">All</option>
	  <option value="add">Add</option>
      <option value="edit">Edit</option>
	  <option value="view">View</option>
      <option value="delete">Delete</option>
    </select></div>
    <label>Staff Permission</label>
      </div>
		        <div class="input-field col s12">
          <input id="address" type="text" name="staff_address" class="validate" required>
          <label for="address">Address</label>
        </div>
      </div>	  

      <div class="row">
        <div class="col s12 mybtn">
         <button name="btnSave" type="submit" class="waves-effect waves-light btn gradient-45deg-red-pink  border-round z-depth-4 mr-1 mb-2" href="#">Save</button>
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
$(document).on('submit', '#create_staff', function(){
    // get form 	

    var create_staff = $(this);	
    var form_data = JSON.stringify(create_staff.serializeObject());
    // submit form data to api
    $.ajax({		
        url: "api/create_staff.php",
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
			alert('Staff Created Failed');			
            //$('#response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
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