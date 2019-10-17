<?php

	if(isset($_POST['customer_id'])){

		$conn = new mysqli('localhost', 'root', '', 'laundry_app');

		//$conn = new mysqli('148.72.232.174', 'laundry_app_2019', 'Avsj0%68', 'laundry_app');



		$results = array('error' => false, 'data' => '');

 

		$querystr = $_POST['customer_id'];

 

		if(empty($querystr)){

			$results['error'] = true;

		}else{

			$sql = "SELECT * FROM shop_customers WHERE customer_id LIKE '%$querystr%'";

			$sqlquery = $conn->query($sql);

 

			if($sqlquery->num_rows > 0){

				while($ldata = $sqlquery->fetch_assoc()){

					$results['data'] .= "

						<li class='list-gpfrm-list' data-fullname='".$ldata['customer_id']."'>".$ldata['customer_id']."</li>

					";

				}

			}

			else{

				$results['data'] = "

					<li class='list-gpfrm-list'>No found data matches Records</li>

				";

			}

		}

 

		echo json_encode($results);

	}

?>