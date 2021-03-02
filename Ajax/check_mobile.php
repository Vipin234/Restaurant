<?php
//require_once("../config.php");
//Code check user name
/*if(!empty($_POST["mobile"])) {
	$result1 = mysqli_query($conn,"SELECT count(*) FROM tbl_supervisor WHERE supv_mobile='" . $_POST["mobile"] . "'");
	$row1 = mysqli_fetch_row($result1);
	$user_count = $row1[0];
	if($user_count>0) echo "<span style='color:red'> Mobile already exist .</span>";
	else echo "<span style='color:green'> Mobile Available.</span>";
} */

// End code check username
require_once("../config.php");
//Code check user name
if(!empty($_POST["mobile"])) {
	$result1 = mysqli_query($conn,"SELECT * FROM tbl_restaurant_staff_registration WHERE mobile_no='" . $_POST["mobile"] . "'");
	//$row1 = mysqli_fetch_row($result1);
        echo mysqli_num_rows($result1);
	} 
// End code check username
?>
