<?php
	// $server = "localhost";
	// $username = "root";
	// $password = "";
	// $database = "pramuka";
	
	
	$server 	= "mysql.idhostinger.com";
	$username 	= "u608270637_army";
	$password 	= "1tambah1=2";
	$database 	= "u608270637_army";
	
	
	// Koneksi dan memilih database di server
	mysql_connect($server,$username,$password) or die("Koneksi gagal");
	mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
