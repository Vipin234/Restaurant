<?php
include '../config.php';
$msg = '';
if(isset($_POST['varify']))
{
	$otp = $_POST['varify_otp'];
	$query = "SELECT * FROM admin_otp WHERE otp_otp = '$otp'";
	$runquery = mysqli_query($conn,$query);
	if(mysqli_num_rows($runquery)>0)
	{
		$msg = "Otp varified successfully";
		header("location:register_admin.php");
	}
	else
	{
		$msg  = "Otp does not matched";
	   header("location:register_admin.php");
	}
}
?>