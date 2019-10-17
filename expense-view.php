<?php
include('header.php');
?>
<div class="section section-data-tables">
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Expense View</h4>
          <div class="row">
            <div class="col s12">
              <div id="page-length-option_wrapper" class="dataTables_wrapper"><table id="page-length-option" class="display dataTable dtr-inline collapsed my_table" role="grid" style="width:100%">
                <thead>
                  <tr role="row">
				  <th class="sorting_asc" aria-sort="ascending">Date</th>
				  <th class="sorting">Amount</th>
				  <th class="sorting">Purpose</th>
				  <th class="sorting">Description</th>
				  <th class="sorting">Status</th>
				  <th class="sorting">Action</th></tr>
                </thead>
                <tbody>
						<?php
				$url="http://www.softwaredemosite.in/api/fetch_all_expenses.php";
				//$url="http://localhost/laundry/api/fetch_all_expenses.php";
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
					$count=1;
					// Will dump a beauty json :3
					$s=json_decode($result, true);
					foreach($s as $item)
					{
						?>					 
						<tr role="row" class="odd">
                    <td class="sorting_1"><?php echo $item['entry_date'];;?></td>
					<td style=""><?php echo $item['exp_amount'];?></td>
					<td><?php echo $item['exp_reason'];?></td>
                    <td><?php echo $item['exp_desc'];?></td>                   
                    <td><?php echo $item['status'];?></td>                    
                    <td><a class="waves-effect waves-light btn-small mb-1">View/Edit</a></td>
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

          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
<?php include('footer.php');?>