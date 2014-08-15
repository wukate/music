<?php
$con=mysqli_connect("127.0.0.1","root","1234","demo");
mysqli_query($con,"SET NAMES 'utf8'");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>