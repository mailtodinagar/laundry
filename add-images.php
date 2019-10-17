<?php
include('header.php');
?>

<div class="row">
    <form class="col s12">
	<h4>Create Images</h4>
      <div class="row">
	  <div class="input-field col s6">
          <input id="staffid" type="text" class="validate">
          <label for="staffid">Image Id</label>
      </div>
 	<div class="input-field col s6">
           <div class="select-wrapper">
		   <select>
		   <option value="" disabled="" selected="">Select Image Location</option>
      <option value="1">Logo</option>
      <option value="2">Others</option>
      
    </select></div>
    <label>Image</label>
      </div>
				        <div class="input-field col s6">
          <input id="address" type="text" class="validate">
          <label for="address">Small Description</label>
        </div>
			  <div class="input-field col s6">
          <div class="file-field input-field">
      <div class="btn">
        <span>Select Image</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
        </div>


      </div>	  

      <div class="row">
        <div class="col s12 mybtn">
         <a class="waves-effect waves-light btn gradient-45deg-red-pink  border-round z-depth-4 mr-1 mb-2" href="#">Save</a>
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
<?php include('footer.php');?>