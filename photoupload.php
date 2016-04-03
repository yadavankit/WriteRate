<?php 
	session_start();	
	$alphabet1=$_POST['alphabet1'];
	$alphabet2=$_POST['alphabet2'];
	$alphabet3=$_POST['alphabet3'];
	$alphabet4=$_POST['alphabet4'];
	$alphabet5=$_POST['alphabet5'];
	$temp_name1=$_FILES['photo1']['tmp_name'];
	$temp_name2=$_FILES['photo2']['tmp_name'];
	$temp_name3=$_FILES['photo3']['tmp_name'];
	$temp_name4=$_FILES['photo4']['tmp_name'];
	$temp_name5=$_FILES['photo5']['tmp_name'];
	$_SESSION['alphabet1']=$_POST['alphabet1'];
	$_SESSION['alphabet2']=$_POST['alphabet2'];
	$_SESSION['alphabet3']=$_POST['alphabet3'];
	$_SESSION['alphabet4']=$_POST['alphabet4'];
	$_SESSION['alphabet5']=$_POST['alphabet5'];
	move_uploaded_file($temp_name1, "uploaded_photo/$alphabet1.jpg");
	move_uploaded_file($temp_name2, "uploaded_photo/$alphabet2.jpg");
	move_uploaded_file($temp_name3, "uploaded_photo/$alphabet3.jpg");
	move_uploaded_file($temp_name4, "uploaded_photo/$alphabet4.jpg");
	move_uploaded_file($temp_name5, "uploaded_photo/$alphabet5.jpg");
	
	echo '<a href="compare_images.php"><button> Redirect </button></a>';
	
?>