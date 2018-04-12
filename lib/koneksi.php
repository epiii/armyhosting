<?php
	$server = "localhost";
	$username = "root";
	$password = "9kali9=81ub";
	$database = "pramuka";
	
	
	// $server 	= "mysql.idhostinger.com";
	// $username 	= "u608270637_army";
	// $password 	= "1tambah1=2";
	// $database 	= "u608270637_army";
	
	
	// Koneksi dan memilih database di server
	$con = mysqli_connect($server,$username,$password) or die("Koneksi gagal");
	mysqli_select_db($con, $database) or die("Database tidak bisa dibuka");
	
	// Koneksi dan memilih database di server
		// mysqli_connect($server,$username,$password) or die("Koneksi gagal");
		// mysqli_select_db($database) or die("Database tidak bisa dibuka");
?>
