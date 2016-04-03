<?php 
	session_start();
	require 'connect.php';	
	$alphabet=$_POST['alphabet'];
	$alphabet1=$_POST['alphabet1'];
	$alphabet2=$_POST['alphabet2'];
	$alphabet3=$_POST['alphabet3'];
	$alphabet4=$_POST['alphabet4'];
	$temp_name=$_FILES['photo']['tmp_name'];
	$temp_name1=$_FILES['photo1']['tmp_name'];
	$temp_name2=$_FILES['photo2']['tmp_name'];
	$temp_name3=$_FILES['photo3']['tmp_name'];
	$temp_name4=$_FILES['photo4']['tmp_name'];
	$_SESSION['alphabet']=$_POST['alphabet'];
	$_SESSION['alphabet1']=$_POST['alphabet1'];
	$_SESSION['alphabet2']=$_POST['alphabet2'];
	$_SESSION['alphabet3']=$_POST['alphabet3'];
	$_SESSION['alphabet4']=$_POST['alphabet4'];
	move_uploaded_file($temp_name, "photo/$alphabet.jpg");
	move_uploaded_file($temp_name1, "photo/$alphabet1.jpg");
	move_uploaded_file($temp_name2, "photo/$alphabet2.jpg");
	move_uploaded_file($temp_name3, "photo/$alphabet3.jpg");
	move_uploaded_file($temp_name4, "photo/$alphabet4.jpg");
	//$sql="INSERT INTO upload (alphabet) VALUES ('$alphabet')";
	//$query=mysqli_query($conn,$sql);
	//if(!$query){
		//echo "<script>alert('Unable to upload');</script>";
	//}
	//else
	//{
		//header("location:compare_images.php");
	//}
?>