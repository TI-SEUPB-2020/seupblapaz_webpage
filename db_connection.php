<?php
$hostname = 'localhost';
$database = 'seupb_photos';
$username = 'seupb';
$password = '123456';

$db_connection = new mysqli($hostname, $username, $password, $database);
if($db_connection->connect_errno) {
	echo "No fue posible conectarse";
}
?>