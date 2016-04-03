<?php 
		$servername='localhost';
		$username='root';
		$password='';
		$db_name = 'hackathon';
		$conn_err='could not connect';
		$conn = mysqli_connect($servername,$username,$password);
		//check connection
		if(!$conn){
			die("failed".$conn_err);
		}
		//create database
		mysqli_select_db($conn,$db_name) or die($conn_err);
		//echo 'connected';
		
		
?>
	