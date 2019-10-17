<?php
$url="http://localhost/laundry/api/read.php";
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
$characters= var_dump(json_decode($result, true));
$s=json_decode($result, true);
foreach($s as $item)
{
            echo "id : ".$item['id'];
            echo "customer_id".$item['customer_id'];
            echo "cus_first_name".$item['cus_first_name'];
			echo"<br>";
}


 $ch = curl_init('http://localhost/laundry/api/read.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data   = json_decode($response,true);
        if($data['status'] == true)
        {
        $_SESSION['licence'] = $data['licence'];
        echo $_SESSION['period'] = $data['period'];
        echo $_SESSION['user'] = $data['user'];
        echo $pin = $_SESSION['licence'];
            //echo "yes";
            //header("Location: setup.php?License=".$pin .'&period='.$_SESSION['period'].'&user='.$_SESSION['user']);
        }else
        {
            echo $data['message'];
        }


?>