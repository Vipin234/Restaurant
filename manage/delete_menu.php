 <?php
include '../config.php';
$menu_id = $_GET['id'];
//echo $staff_id;exit;
$query = "UPDATE tbl_restaurant_menu_item_list SET status = 0 WHERE id = $menu_id";
//echo $query;exit;
$run = mysqli_query($conn,$query);
if($run)
{
	header("location:restaurant_menu.php");
}

?>