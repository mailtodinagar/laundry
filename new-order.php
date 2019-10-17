<?php
include('header.php');
?>
<style type="text/css">

		.gst20{

			margin-top:20px;

		}

		#hdTuto_search{

			display: none;

		}

		.list-gpfrm-list a{

			text-decoration: none !important;
			

		}

		.list-gpfrm li{

			cursor: pointer;

			padding: 4px 0px;

		}

		.list-gpfrm{

			list-style-type: none;			
    		background: #fff;
			margin-top:0px;			

		}

		.list-gpfrm li:hover{

			color: white;

			background-color: #3d3d3d;

		}
		.td_order_id
		{
			display:none;
		}
	</style>
<div class="row">
    <form class="col s12" id="orderform" method="post">
	<h5>Create Order</h5>
	<h6 class="right-align" style="margin-top:-30px">Wallet Amount: <span style="color:red;" id="wallet_amt">00.00</span></h6>
	<!-- <div class="row">
	  <div class="input-field col s3"></div>
        <div class="input-field col s6">
            <textarea id="textarea24" class="materialize-textarea"></textarea>
          <label for="textarea24">Search Customer By Name,Customer ID,Email,Contact</label>
        </div>
		  <div class="input-field col s3"></div>
      </div>-->
      <div class="row">
        <div class="input-field col s4">
		 <input type="text" id="customer_id" name="customer_id" class="autocomplete" autocomplete="off" required>
        <label for="customer_id">Customer Id</label>
		<div>
	<ul class="list-gpfrm" id="hdTuto_search"></ul>
	</div>
      </div>      

        <div class="input-field col s4">
          <input id="customer_name" name="customer_name" type="text" class="validate" required readonly>
          <label for="customer_name">Customer Name</label>
      </div>
	    <div class="input-field col s4">
          <input id="cus_contact" name="cus_contact" type="text" class="validate" required readonly>
          <label for="cus_contact">Contact</label>
        </div>
      </div>	 
	   <div class="row card card-tabs">
	    <div class="col s12 m12 l12" style="background:#f6f3f3">				 
		       <div class="input-field col s2">
          <input id="product_id" name="product_id" type="text" class="validate">
          <label for="product_id">Product Id</label>
		  <!--<input type="hidden" id="product_name">-->
        </div>
		<div class="input-field col s1">
          <input id="product_name" name="product_name" type="text" class="validate" required />
          <label for="product_name">Product Name</label>
        </div>
		<div class="input-field col s2">
                     <select name="ddlProcess" id="ddlProcess" required>
      <option value="" disabled="" selected="">Select Process</option>
      <option value="Stream_Iron">Stream_Iron</option>
      <option value="Hard_Wash">Hard_Wash</option>
      <option value="Wash_Only">Wash_Only</option>
	   <option value="Iron">Iron</option>
      <option value="Dry Clean">Dry_Clean</option>
	   <option value="Washing_and_Iron">Washing_and_Iron</option>
      <option value="Wash_Stream_Iron">Wash_Stream_Iron</option>
    </select>
        </div>
		<div class="input-field col s1">
          <input id="qty" name="qty" type="number" class="validate" required />
          <label for="qty">Quantity</label>
        </div>
		<div class="input-field col s1">
          <input id="price" name="price" type="number" class="validate" required readonly />
          <label for="price">Price</label>
        </div>
		<div class="input-field col s1">
		<p>
          <label>
        <input type="radio" value="ordinary" name="rbtnType" id="rbtnType" />
        <span style="padding-left: 20px;">Ordinary</span>
      </label>
	  </p>
	  
        </div>		
		<div class="input-field col s1">
		<p>
          <label>
        <input type="radio" name="rbtnType" value="urgent" id="rbtnType" />
        <span style="padding-left: 20px;">Urgent</span>
      </label>
	  </p>
	  
        </div>	
<div class="input-field col s1">
		<p>
          <label>
        <input type="radio" value="express" name="rbtnType" id="rbtnType" />
        <span style="padding-left: 20px;">Express</span>
      </label>
	  </p>
	  
        </div>			
		<div class="input-field col s1">
         <a id="btnAddproduct" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round z-depth-4 mr-1 mb-2" href="#!" style="margin-top: 12px;">Add</a>
        </div>
	   </div>
	   <div class="col s5 m5 l5">
	   <?php
				$url="http://www.softwaredemosite.in/api/fetch_all_product.php";			
				//$url="http://localhost/laundry/api/fetch_all_product.php";
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
		 <div class="input-field col s3 m3 l3">
          <img src="<?php echo $item["product_image"];?>" class="img-responsive" style="width:80px;height:80px;">
		  <span><p class="increment-btn"><a name="btnAdd" id="<?php echo $item["id"]; ?>" class="btn-floating mb-1 waves-effect waves-light add_product">
                    <i class="material-icons">add</i>
                  </a></p></span>
        </div>
		<?php
					}
		?>

		</div>
		 <div class="col s7 m7 l7">
 
		
		<div class="invoice-table">
              <div class="row">
                <div class="col s12 m12 l12">
                  <table class="highlight responsive-table" id="listtable">
                    <thead>
                      <tr>
                        <th>No</th>
						<th style="display:none">order_id</th>
                        <th>product_name</th>
						 <th>process_type</th>
                        <th>unit_cost</th>
                        <th>product_qty</th>
                        <th>total</th>
						<th>Remove</th>
                      </tr>
                    </thead>
                    <tbody id="tblbody">
                     
					 <tfoot>
                      <tr class="border-none">
					     
                        <td>Service Tax:</td>
                        <td>
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
						<input id="taxpercentage" name="taxpercentage" value="<?php echo $item["tax_percentage"];?>" type="text" class="validate" readonly>
						<?php
					}
					?>
						</td>   
						<td>Discount:</td>
                        <td><input id="discount" id="discount" type="text" value="00" class="validate"></td> 
						
                        <td><span id="totalqty">0</span></td>							
                       
                        <td><span>&#65020;</span><span id="subtotal"> 00.00</span></td>						
                      </tr>                    
                      <tr class="border-none">
                        <td class="cyan white-text pl-1">Tax Amount</td>
						<td class="cyan strong white-text"><span>&#65020;</span><span id="taxtotal">00.00</span></td>
                        <td class="cyan white-text pl-1">Grand Total</td>
                        <td class="cyan strong white-text"><span>&#65020;</span><span id="grandtotal">00.00</span></td>
                      </tr>
					  </tfoot>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
      </div>  
</div>	  
      <div class="row">
	  <span id="ccc"></span>
        <div class="col s12 mybtn">
		<a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round z-depth-4 mr-1 mb-2" href="#">Send Sms</a>
         <a class="waves-effect waves-light btn gradient-45deg-red-pink  border-round z-depth-4 mr-1 mb-2" href="#">Pay By Wallet</a>
		 <a id="btnPaynow" class="waves-effect waves-light btn gradient-45deg-green-teal  border-round z-depth-4 mr-1 mb-2" href="#">Pay Now</a>
		  <a class="waves-effect waves-light btn gradient-45deg-amber-amber  border-round z-depth-4 mr-1 mb-2" href="#">Pay Later</a>
		
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
<!-- jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script type="text/javascript">

	$(document).ready(function(){

	//Autocomplete search using PHP, MySQLi, Ajax and jQuery

		//generate suggestion on keyup

		$('#customer_id').keyup(function(e){

			e.preventDefault();

			var form = $('#orderform').serialize();

			$.ajax({

				type: 'POST',

				url: 'do_search.php',

				data: form,

				dataType: 'json',

				success: function(response){

					if(response.error){

						$('#hdTuto_search').hide();

					}

					else{

						$('#hdTuto_search').show().html(response.data);

					}

				}

			});

		});



		//fill the input

		$(document).on('click', '.list-gpfrm-list', function(e){

			e.preventDefault();

			$('#hdTuto_search').hide();

			var fullname = $(this).data('fullname');

			$('#customer_id').val(fullname);
			var id = $('#customer_id').val();
			$.ajax({
			url:"api/fetch_single_customer.php?id="+id,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{	
				$('#customer_name').siblings('label').addClass('active');			
				$('#customer_name').val(data['cus_first_name']);
				$('#cus_contact').siblings('label').addClass('active');
				$('#cus_contact').val(data['cus_contact']);
				$("#wallet_amt").text(data['wallet_amt']);				
			}			
		});

		});

	});

</script>
<script>
	$(document).ready(function(){		
		/*$(function() {
    $("#ddlProcess").change(function() {
        alert( $('option:selected', this).text() );
    });
});*/
//add product code
$('a.add_product').click(function() { 
    var id = $(this).attr('id');   		
			$.ajax({
			url:"api/fetch_single_product.php?id="+id,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{	
				$('#product_id').siblings('label').addClass('active');			
				$('#product_id').val(data['product_id']);
				$('#product_name').siblings('label').addClass('active');	
				$('#product_name').val(data['product_name']);				
			}			
		});
    return false; 
});
//dropdown process value
$("#ddlProcess").change(function () {                            
   var category= $('select[name=ddlProcess]').val(); // Here we can get the value of selected item
   		var id = $('#product_id').val();
			$.ajax({
			url:"api/fetch_single_pricing.php?id="+id+"&process="+category,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{	
				$('#price').siblings('label').addClass('active');			
				$('#price').val(data['product_cost']);							
			}			
		});  
});
//add product to table
$('#btnAddproduct').click(function(e){
  e.preventDefault();  // this is how to stop the form submitting
  var id = $('#product_id').val();
  var name = $('#product_name').val();
  var category= $('select[name=ddlProcess]').val();
  var qty = $('#qty').val();  // us an id selector - it is much better performance
  var price = $('#price').val();
  var rowCount = $('#listtable >tbody >tr').length;

  if(rowCount==0)
  {
	 rowCount=1; 
  }
  else
  {
	  rowCount+=1;
  }
  if (id != '' && name != '' && category != '' && qty != '' && price != '') { // check if textbox was empty (not sure what your loop did)
	  $('#tblbody').append('<tr class="tblrow"><td>' + rowCount + '</td><td class="td_order_id"></td><td>' + name + '</td><td>' + category + '</td><td class="unitprice">' + price + '</td><td class="qtytot">' + qty + '</td><td class="totalsum">' + qty*price + '</td><td><a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange removebutton"><i class="material-icons">clear</i></a></td></tr>');
    
calc_total();
calc_taxtotal();
  }
});
//remove product from table
 $(document).on('click', 'a.removebutton', function () {
     if (confirm("Are you sure? You Want delete?")) {
        $(this).closest('tr').remove();
		calc_total();
		calc_taxtotal();
    }
	else
	{
    return false;
    }
     
 });


function calc_total(){
  var sum = 0;
  var qtytot=0;
  $(".totalsum").each(function(){
    sum += parseFloat($(this).text());
  });
  $('#subtotal').text(sum.toFixed(2));
	  //calculate total qty
  $(".qtytot").each(function(){
    qtytot += parseFloat($(this).text());
  });
  $('#totalqty').text(qtytot);
   //calculate total qty
}
function calc_taxtotal(){
	  var nettotal = parseFloat($('#subtotal').text());
	  var taxper = parseFloat($('#taxpercentage').val());
	  var taxamount=(nettotal*taxper)/100;
	  grndtot = nettotal+((nettotal*taxper)/100);	 
	   $('#grandtotal').text(grndtot.toFixed(2));
	   $('#taxtotal').text(taxamount.toFixed(2));
}

$('#discount').change(function () {	
   var grndtot=0;
	  var grndtotal = parseFloat($('#grandtotal').text());
	  var discountper = parseFloat($('#discount').val());
	  grndtot = grndtotal-((grndtotal*discountper)/100);
	  $('#grandtotal').text(grndtot.toFixed(2));  
});

$('input[type=radio][name=rbtnType]').on('change', function() {
	var percentagetype= $(this).val();	
	var percentageratio=0;
	var sum = 0;
	var qtytot=0;
	if(percentagetype!='ordinary')
	{
	$.ajax({
			url:"api/fetch_single_percentage.php?type="+percentagetype,
			method:"POST",
			//data:{id:fullname},
			dataType:"json",
			success:function(data)
			{							
				 percentageratio = data['inc_percentage'];					  
				  $(".tblrow").each(function(){
					   var qty = parseFloat($(this).find(".qtytot").text());
						var unitcost = parseFloat($(this).find(".unitprice").text());						
						var totalcost = (unitcost*qty);
						var totalwithpercentage = (totalcost*percentageratio)/100;					
						$(this).find(".totalsum").text(totalcost+=totalwithpercentage);
						calc_total();
						calc_taxtotal();
				  });			
			}			
		}); 
} 
else
{
						$(".tblrow").each(function(){
					   var qty = parseFloat($(this).find(".qtytot").text());
						var unitcost = parseFloat($(this).find(".unitprice").text());						
						var totalcost = (unitcost*qty);										
						$(this).find(".totalsum").text(totalcost);
						calc_total();
						calc_taxtotal();
				  });
}	
		});  
		$('#btnPaynow').click( function() {
			//alert('im');
			
			var tbody = $("#listtable tbody");
			if(tbody.children().length == 0){
				alert('enter data');
			}
			else
			{
				
				

	 function IDGenerator() {
	 
		 this.length = 8;
		 this.timestamp = +new Date;
		 
		 var _getRandomInt = function( min, max ) {
			return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
		 }
		 
		 this.generate = function() {
			 var ts = this.timestamp.toString();
			 var parts = ts.split( "" ).reverse();
			 var id = "";
			 
			 for( var i = 0; i < this.length; ++i ) {
				var index = _getRandomInt( 0, parts.length - 1 );
				id += parts[index];	 
			 }
			 
			 return id;
		 }

		 
	 }
	//generate order id 	 
var generator = new IDGenerator();
var uniqid = generator.generate();
$('.td_order_id').text(uniqid);
var obj = { order_id:uniqid,customer_id:$('#customer_id').val(),customer_name:$('#customer_name').val(),customer_contact:$('#cus_contact').val(),process_type:$('#rbtnType').val(),tax_percentage:$('#taxpercentage').val(),tax_amount:$('#taxtotal').text(),discount_percentage:$('#discount').val(),discount_amount:$('#taxtotal').text(),total_qty:$('#totalqty').text(),net_amount:$('#subtotal').text(),payable_amount:$('#grandtotal').text()};
var myJSON = JSON.stringify(obj);


 $('#listtable tr').find('th:last-child').remove();
 var myRows =[];
var $th = $('table th');
$('table tbody tr').each(function(i, tr){
	$(this).find('td:last-child').remove();
    var obj = {}, $tds = $(tr).find('td');
    $th.each(function(index, th){
        obj[$(th).text()] = $tds.eq(index).text();
    });
    myRows.push(obj);
});

var orderlist= JSON.stringify(myRows);

 $.ajax({		
        url: "api/create_order.php",
        type : "POST",
        contentType : 'application/json',
        data : myJSON,		
        success : function(result) {
            // if response is a success, tell the user it was a successful sign up & empty the input boxes
            //$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
			//alert('Order Add Successfully');			
            //create_customer.find('input').val('');
			<!-- store order list-->
			 $.ajax({		
        url: "api/create_order_list.php",
        type : "POST",
        contentType : 'application/json',
        data : orderlist,		
        success : function(result) {
            // if response is a success, tell the user it was a successful sign up & empty the input boxes
            //$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
			alert('Order Add Successfully');			
            //create_customer.find('input').val('');
        },
        error: function(xhr, resp, text){
            // on error, tell the user sign up failed
			alert('Order Add Failed');		
            //$('#response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
        }
    });
	<!--store order list-->
        },
        error: function(xhr, resp, text){
            // on error, tell the user sign up failed
			alert('Order Add Failed');		
            //$('#response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
        }
    });
	

		}
});

	});
</script>
<script>
		 <!---------------------------Signup Start------------------------------------------->
$(document).ready(function(){
$(document).on('submit', '#orderform', function(){
    // get form 	

    var create_customer = $(this);	
    var form_data = JSON.stringify(create_customer.serializeObject());
    // submit form data to api
    $.ajax({		
        url: "api/create_customer1.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,		
        success : function(result) {
            // if response is a success, tell the user it was a successful sign up & empty the input boxes
            //$('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
			alert('Customer Add Successfully');			
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
});
 	 	$('#orderform').on('submit', function(event){			
		event.preventDefault();		
		if($('#cus_contact').val() == '')
		{
			alert("Enter First Name");
		}
		
		else
		{				
			const json = serialize_form(this);	
alert(json);			
			$.ajax({
				url: "api/update_customer1.php",
				method: "POST",
				contentType: 'application/json',
				data: json,
				success:function(data)
				{									
					$('#modal1').modal('close');
					location.reload(true);
					alert('Customer Update Success');					
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
 <!---------------------------Signup end------------------------------------------->
	</script>
	
<?php include('footer.php');?>