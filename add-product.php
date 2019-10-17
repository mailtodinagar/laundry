<?php
include('header.php');
?>

<div class="row">
    <form class="col s12" method="post" id="create_product" enctype="multipart/form-data">
	<h4>Create Product</h4>
      <div class="row">
	  <div class="input-field col s6">
          <input id="product_id" name="product_id" type="text" class="validate" required>
          <label for="product_id">Product Id</label>
      </div>
        <div class="input-field col s6">
          <input id="product_name" name="product_name" type="text" class="validate" required>
          <label for="product_name">Product Name</label>
      </div>
	  <div class="input-field col s12">
          <div class="file-field input-field">
      <div class="btn">
        <span>Product Image</span>
        <input type="file" name="product_image">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
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
$(document).on('submit', '#create_product', function(){
    // get form 	

    var create_product = $(this);
    var form_data = JSON.stringify(create_product.serializeObject());		
    // submit form data to api
    $.ajax({		
        url: "api/create_product.php",
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
			alert('Product Created Failed');			
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