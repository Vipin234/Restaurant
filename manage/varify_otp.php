<?php
include '../config.php';
session_start();
$msg = '';
$_SESSION['msg'] = $msg;
if(isset($_POST['varify']))
{
	//echo "pankaj";exit;	
	$otp = $_POST['varify_otp'];
	$query = "SELECT * FROM admin_otp WHERE otp_otp = '$otp'";
	$runquery = mysqli_query($conn,$query);
	if(mysqli_num_rows($runquery)>0)
	{
		$msg = "Otp varified successfully";
		$_SESSION['msg'] = $msg;
		header("location:register_admin.php");
	}
	else
	{
		$msg  = "Otp does not matched";
		$_SESSION['msg'] = $msg;
	   header("location:register_admin.php");
	}
}
?>