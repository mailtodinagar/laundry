<?php
include('header.php');
?>

<div class="row">
    <div class="col s12 m12 l12">
      <div id="basic-tabs" class="card card card-default scrollspy">
        <div class="card-content pt-5 pr-5 pb-5 pl-5">
          <div id="invoice">
            <div class="invoice-header">
              <div class="row section">
                <div class="col s12 m6 l6">
                  <img class="mb-2 width-50" src="images/main_logo.png" alt="company logo">
                  <p>125, Rajaji Street, Adayar, Chennai</p>
                  <p>+91 9566336048</p>
                </div>
                <div class="col s12 m6 l6">
                  <h4 class="text-uppercase right-align strong mb-5">Invoice</h4>
                </div>
              </div>
              <div class="row section">
                <div class="col s12 m6 l6">
                  <h6 class="text-uppercase strong mb-2 mt-3">Recipient</h6>
                  <p class="text-uppercase">Vignesh Raj</p>
                  <p>12/B,Narayanasamy Street, West Saidapet, Chennai</p>
                  <p>VAT no.: 18012384</p>
                </div>
                <div class="col s12 m6 l6">
                  <div class="invoce-no right-align">
                    <p><span class="text-uppercase strong">Invoice No.</span> 324/2019</p>
                  </div>
                  <div class="invoce-no right-align">
                    <p><span class="text-uppercase strong">Invoice Date</span> June 03 2019</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="invoice-table">
              <div class="row">
                <div class="col s12 m12 l12">
				<table>
					<tr>
						<td>
						
						</td>
					</tr>
				</table>
                  <table class="highlight responsive-table">
                    <thead>
                      <tr>
                        <th data-field="no">No</th>
                        <th data-field="item">Item</th>
						 <th data-field="type">Type</th>
                        <th data-field="uprice">Unit Price</th>
                        <th data-field="price">Unit</th>
                        <th data-field="price">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Shirt</td>
						 <td>Wash</td>
                        <td>$ 100.00</td>
                        <td>2</td>
                        <td>$ 200.00</td>
                      </tr>
                      <tr>
                       <td>2.</td>
                        <td>Silk Saree</td>
						 <td>Dry Wash and Iron</td>
                        <td>$ 200.00</td>
                        <td>3</td>
                        <td>$ 600.00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cotton Pant</td>
						 <td>Iron</td>
                        <td>$ 100.00</td>
                        <td>2</td>
                        <td>$ 200.00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Jeans Pant</td>
						 <td>Wash and Iron</td>
                        <td>$ 500.00</td>
                        <td>2</td>
                        <td>$ 1000.00</td>
                      </tr>
                      <tr>
                        <td>5.</td>
                         <td>Churidhar</td>
						 <td>Wash and Iron</td>
                        <td>$ 400.00</td>
                        <td>1</td>
                        <td>$ 400.00</td>
                      </tr>
                      <tr class="border-none">
                        <td colspan="4"></td>
                        <td>Sub Total:</td>
                        <td>$ 2,400.00</td>
                      </tr>
                      <tr class="border-none">
                        <td colspan="4"></td>
                        <td>Service Tax</td>
                        <td>11.00%</td>
                      </tr>
                      <tr class="border-none">
                        <td colspan="4"></td>
                        <td class="cyan white-text pl-1">Grand Total</td>
                        <td class="cyan strong white-text">$ 2,664.00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="invoice-footer mt-6">
              <div class="row">
                <div class="col s12 m6 l6">
                  <p class="strong">Payment Method</p>
                  <p>Please make the cheque to: Vikilead</p>
                  <p class="strong">Terms &amp; Condition</p>
                  <ul>
                    <li>You know, being a test pilot isn't always the healthiest business in the world.</li>
                    <li>We predict too much for the next year and yet far too little for the next 10.</li>
                  </ul>
                </div>
                <div class="col s12 m6 l6 center-align">
                  <p>Approved By</p>
                  <!--<img src="../../../app-assets/images/misch/signature-scan.png" alt="signature">-->
                  <p class="header">Vikilead</p>
                  <p>Managing Director</p>
                </div>
              </div>
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