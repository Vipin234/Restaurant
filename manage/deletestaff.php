 <?php 
include '../config.php';
$staff_id = $_GET['id'];
//echo $staff_id;exit;
$query = "UPDATE tbl_restaurant_staff_registration SET status = 0 WHERE id = $staff_id";
$run = mysqli_query($conn,$query);
if($run)
{
	header("location:stafflist.php");
}

?>