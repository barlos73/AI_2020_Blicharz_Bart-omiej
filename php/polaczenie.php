<?php

	$servername="localhost";
	$db_user="root";
	$db_password="";
	$db_name = "projekt";
	$conn = mysqli_connect($servername,$db_user,$db_password,$db_name);
	if(!$conn){
		die("Blad polaczenia: ".mysqli_connect_error());
	}
?>