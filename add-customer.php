<?php
include('header.php');
?>

<div class="row">
    <form class="col s12 regform" id="create_customer" method="post" enctype="multipart/form-data">
	<h4>Add Customer</h4>
      <div class="row">	
        <div class="input-field col s6">
		  <input id="customer_id" type="hidden" name="customer_id" class="">   
          <input id="cus_first_name" type="text" class="" name="cus_first_name" required>
          <label for="cus_first_name">First Name <span style="color:red">*</span></label>
      </div>
	   <div class="input-field col s6">
          <input id="cus_last_name" type="text" name="cus_last_name" class="">
          <label for="cus_last_name">Last Name</label>
        </div>
      </div>
       <div class="row">	        
        <div class="input-field col s6">
          <input id="cus_email" type="email" name="cus_email" class="" required>
          <label for="cus_email">Email</label>
      </div>
      <div class="input-field col s6">
          <input id="cus_contact" type="text" name="cus_contact" class="" required>
          <label for="cus_contact">Mobile No<span style="color:red">*</span></label>
        </div>
      </div>
      <div class="row">
       
<div class="input-field col s6">
 <select name="cus_gender">
      <option value="" disabled selected>Select Gender</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="shemale">Shemale</option>
    </select>
    <label>Gender</label>
</div>	
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
      </div>
	  <div class="row">
	  
	          <div class="input-field col s6">
           <select name="cus_type" required>
      <option value="" disabled selected>Select Type</option>
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
	  </div>
      <div class="row">
        <div class=" form-group input-field col s12">
            <input type="text" id="cus_address" name="cus_address" class="materialize-textarea"/>
          <label for="cus_address">Address</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 mybtn">
         <input type="submit" name="btnAdd" id="btnAdd" class="waves-effect waves-light btn gradient-45deg-red-pink  border-round z-depth-4 mr-1 mb-2" href="#" value="Save">
		 <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round z-depth-4 mr-1 mb-2" href="#">Cancel</a>
		 </div>
		   </form>
	<ul class="collapsible" data-collapsible="accordion">
   <li>
   <div class="collapsible-header"><i class="material-icons">keyboard</i>Virtual Keyboard</div>
   <div class="collapsible-body height_class" >
                  <div id="virtualkeyboard" class="panel-collapse collapse">
        <div class="panel-body">
<ul class="keyboard">
  <li class="char">^</li>
  <li class="char">1</li>
  <li class="char">2</li>
  <li class="char">3</li>
  <li class="char">4</li>
  <li class="char">5</li>
  <li class="char">6</li>
  <li class="char">7</li>
  <li class="char">8</li>
  <li class="char">9</li>
  <li class="char">0</li>
  <li class="char">-</li>
  <li class="char">_</li>
  <li class="backspace last"><span class="glyphicon glyphicon-arrow-left"></span></li>
  <li class="tab"><span class="glyphicon glyphicon-transfer"></span></li>
  <li class="char">q</li>
  <li class="char">w</li>
  <li class="char">e</li>
  <li class="char">r</li>
  <li class="char">t</li>
  <li class="char">y</li>
  <li class="char">u</li>
  <li class="char">ı</li>
  <li class="char">o</li>
  <li class="char">p</li>
  <li class="char">ğ</li>
  <li class="char">ü</li>

  <li class="capslock">c.lock</li>
  <li class="char">a</li>
  <li class="char">s</li>
  <li class="char">d</li>
  <li class="char">f</li>
  <li class="char">g</li>
  <li class="char">h</li>
  <li class="char">j</li>
  <li class="char">k</li>
  <li class="char">l</li>
  <li class="char">ş</li>  
  <li class="char">i</li>

  <li class="return last">return</li>
  <li class="char at">@</li>
  <li class="char">`</li>
  <li class="char">z</li>
  <li class="char">x</li>
  <li class="char">c</li>
  <li class="char">v</li>
  <li class="char">b</li>
  <li class="char">n</li>
  <li class="char">m</li>
  <li class="char">ö</li>
  <li class="char">ç</li>
  <li class="char">?</li>
  <li class="char">_</li>
  <li class="char">=</li>
  <li class="char">|</li> 
  <li class="space"><span class="glyphicon glyphicon-resize-horizontal"></span></li>
</ul>
    </div>
    </div>
 </div>
   </li>  
	</ul>
          
		
      
      </div>  
  </div>




<!-- END RIGHT SIDEBAR NAV -->

          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
	<!--<script src="js/jquery-3.2.1.min.js"></script>-->


	<script>
		 <!---------------------------Signup Start------------------------------------------->
$(document).ready(function(){
			$.ajax({
			url:"api/get_customer_id.php",
			method:"GET",			
			dataType:"json",      
			success: function(data){				       
				$("#customer_id").val(data.customer_id);			
        },
        error: function(d){
            /*console.log("error");*/
            alert("404. Please wait until the File is Loaded.");
        }		
		});
$(document).on('submit', '#create_customer', function(){
    // get form 	

		
    var create_customer = $(this);	
    var form_data = JSON.stringify(create_customer.serializeObject());	
    // submit form data to api
	//confirm(form_data);
    $.ajax({		
        url: "api/create_customer.php",
        type : "POST",
        //contentType : 'application/json',
		contentType: false,
        cache: false,
        processData:false,
        data : form_data,		
        success : function(result) {
			alert(result.message);
			location.reload();
            // if response is a success, tell the user it was a successful sign up & empty the input boxes
            //$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");						
            //create_customer.find('input').val('');
        },
        error: function(xhr, resp, text){
            // on error, tell the user sign up failed
			alert('Customer Add Failed');		
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