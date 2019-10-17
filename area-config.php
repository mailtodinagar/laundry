<?php
include('header.php');
?>

<div class="row">
    <form class="col s12" method="post" id="create_shop">
	<h4>Create Region</h4>
      <div class="row">
        <div class="input-field col s6">
          <input id="shop_name" name="shop_name" type="text" class="validate" required>
          <label for="shop_name">Shop Name</label>
      </div>
	   <div class="input-field col s6">
           <select name="shop_country" required>
      <option value="" disabled selected>Select City</option>
      <option value="india">India</option>
      <option value="uk">UK</option>
      <option value="usa">USA</option>
    </select>
    <label>City</label>
      </div>
     
      </div>
	  
     
     
	   <div class="row">
        <div class="input-field col s6">
          <input id="tax_no" name="tax_no" type="text" class="validate" required>
          <label for="tax_no">Tax Number</label>
        </div>
		 <div class="input-field col s6">
          <input id="tax_percentage" name="tax_percentage" type="text" class="validate" required>
          <label for="tax_percentage">Tax Percentage</label>
        </div>	 
     
      </div>
	  <div class="row">
	  <div class="input-field col s6">
            <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" name="fuImg" type="text">
      </div>
    </div>
        </div>	   
		 <div class="input-field col s6">
           <textarea id="shop_desc" name="shop_desc" class="materialize-textarea"></textarea>
          <label for="shop_desc">Description</label>
        </div>
	  </div>
	    <div class="row">
			 <div class="input-field col s12">
           <textarea id="shop_address" name="shop_address" class="materialize-textarea" required></textarea>
          <label for="shop_address">Shop Address</label>
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
$(document).on('submit', '#create_shop', function(){
    // get form 	

    var create_shop = $(this);	
    var form_data = JSON.stringify(create_shop.serializeObject());
    // submit form data to api
    $.ajax({		
        url: "api/create_shop.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,		
        success : function(result) {
            // if response is a success, tell the user it was a successful sign up & empty the input boxes
            //$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
			alert('Shop Created Successfully');			
            //create_customer.find('input').val('');
        },
        error: function(xhr, resp, text){
            // on error, tell the user sign up failed
			alert('Shop Created Failed');			
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