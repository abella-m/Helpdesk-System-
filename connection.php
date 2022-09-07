<?php
		// server configuration
		//$dbservername = "localhost";
		//$dbusername = "root";
		//$dbpassword = "";
		//$dbname = "db_helpdesk";

		// Create connection
		//$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
		$conn = mysqli_connect("localhost","root","","db_helpdesk");

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connection_error);
		}
?>