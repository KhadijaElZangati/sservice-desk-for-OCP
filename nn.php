<?php
	$conn = new PDO('mysql:host=localhost;dbname=authentication', 'root', '');
 
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>