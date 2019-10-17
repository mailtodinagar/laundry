<?php
include('header.php');
?>
<div class="row">
    <form class="col s12" method="post" id="create_expense">
	<h4>Add Expenses</h4>
      <div class="row">
	   <div class="input-field col s6">
          <input id="cus_id" type="date" class="validate" name="entry_date" required>
          <label for="cus_id">Date</label>
      </div>
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" name="exp_amount" required>
          <label for="first_name">Amount <span style="color:red">*</span></label>
      </div>
      </div>	  
       <div class="row">
	        <div class="input-field col s6">
 <select name="exp_reason" required>
      <option value="" disabled selected>Select Expense</option>
	  <option value="shop_employee_salary">shop_employee_salary</option>
      <option value="material">material</option>
      <option value="rent_for_the_shop">rent_for_the_shop</option>
	  <option value="electric_bill_payment">electric_bill_payment</option>
	  <option value="water_rental">water_rental</option>
      <option value="other_expenses">other_expenses</option>
    </select>
    <label>Expense Reason</label>
</div>	
        <div class="input-field col s6">
          <input id="email" type="text" class="validate" name="exp_desc" required>
          <label for="email">Description</label>
      </div>
     
      </div>     

      <div class="row">
        <div class="col s12 mybtn">
         <button type="submit" name="btnSave" class="waves-effect waves-light btn gradient-45deg-red-pink  border-round z-depth-4 mr-1 mb-2" href="#">Save</button>
		 <button type="reset" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round z-depth-4 mr-1 mb-2" href="#">Cancel</button>
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
$(document).on('submit', '#create_expense', function(){
    // get form 	

    var create_expense = $(this);	
    var form_data = JSON.stringify(create_expense.serializeObject());
    // submit form data to api
    $.ajax({		
        url: "api/create_expense.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,		
        success : function(result) {
            // if response is a success, tell the user it was a successful sign up & empty the input boxes
            //$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
			alert('Expense Add Successfully');			
            //create_customer.find('input').val('');
        },
        error: function(xhr, resp, text){
            // on error, tell the user sign up failed
			alert('Expense Add Failed');		
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