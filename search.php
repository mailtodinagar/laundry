<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'laundry_app';

$mysqli = new mysqli($host, $user, $password, $database);

$username = $_GET['username'];
$startFrom = $_GET['startFrom'];

$username = trim(htmlspecialchars($username));
$startFrom = filter_var($startFrom, FILTER_VALIDATE_INT);

$like = '%' . strtolower($username) . '%';
$statement = $mysqli -> prepare('
	SELECT * 
	FROM shop_customers 
	WHERE lower(name) LIKE ?  
	ORDER BY INSTR(title, ?), title
	LIMIT 6 OFFSET ?'
);

if (
	$statement &&
	$statement -> bind_param('ssi', $like, $username, $startFrom) &&
	$statement -> execute() &&
	$statement -> store_result() &&
	$statement -> bind_result($name, $picture, $description)
) {
	$array = [];
	while ($statement -> fetch()) {
		$array[] = [
			'name' => $name,
			'picture' => $picture,
			'description' => $description
		];
	}
	echo json_encode($array);
	exit();
}