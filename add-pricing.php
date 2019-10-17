<?php
include('header.php');
?>

<div class="row">
    <form class="col s12" method="post" id="create_pricing" enctype="multipart/form-data">
	<h4>Create Pricing</h4>
      <div class="row">
	  <div class="input-field col s6">
           <div class="select-wrapper">
		   <select name="product_id" required>
		   <option value="" disabled="" selected="">Select Product Id</option>
		   <?php
				//$url="http://www.softwaredemosite.in/api/fetch_all_product.php";
				$url="http://localhost/laundry/api/fetch_all_product.php";
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
					$count=1;
					foreach($s as $item)
					{
					?>
					  <option value="<?php echo $item['product_id'];?>"><?php echo $item['product_id'];?></option>
					 <?php
					}
					?>
    </select></div>   
      </div>  
   <!--<div class="input-field col s6">
          <input id="product_name" name="product_name" type="text" class="validate" readonly required>
          <label for="product_name">Product Name</label>
        </div>	 -->	  
	  <div class="input-field col s6">
           <div class="select-wrapper">
		   <select name="product_process" required>
		   <option value="" disabled="" selected="">Select Process</option>
      <option value="Stream_Iron">Stream Iron</option>
      <option value="Hard_Wash">Hard Wash</option>
      <option value="Wash_Only">Wash Only</option>
	   <option value="Iron">Iron</option>
      <option value="Dry Clean">Dry Clean</option>
	   <option value="Washing_and_Iron">Washing & Iron</option>
      <option value="Wash_Stream_Iron">Wash Stream Iron</option>
    </select></div>
    <label>Cloth Process</label>
      </div>	 
	        <div class="input-field col s6">
          <input id="product_cost" name="product_cost" type="text" class="validate" required>
          <label for="product_cost">Amount</label>
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
$(document).on('submit', '#create_pricing', function(){
    // get form 	

    var create_pricing = $(this);
    var form_data = JSON.stringify(create_pricing.serializeObject());
	
    // submit form data to api
    $.ajax({		
        url: "api/create_pricing.php",
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
			alert('Price Created Failed');			
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