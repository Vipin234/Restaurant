 <?php
include '../config.php';
$admin_id = $_GET['id'];
//echo $staff_id;exit;
$query = "UPDATE tbl_admin SET user_active = 0 WHERE user_id = $admin_id";
//echo $query;exit;
$run = mysqli_query($conn,$query);
if($run)
{
	header("location:admin.php");
}

?>