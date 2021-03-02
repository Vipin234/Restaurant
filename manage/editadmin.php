<?php
include '../config.php';
include 'header.php';
session_start();
$userid   = $_SESSION['userid'];
$adminid  = $_SESSION['adminid']; 
$userrole = $_SESSION['userrole'];
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$admin_id = $_GET['id'];
if($adminid == '')
{
  header("location:login.php");
}
//echo $staff_id;exit;
date_default_timezone_set('Asia/Kolkata'); 
if(isset($_POST['register'])){
//	echo "pankaj";
	$fullname = $_POST['fullname'];
/*	$lastname  = $_POST['lastname'];*/
	//echo $lastname;exit;
	$username  = $_POST['username'];
	$email     = $_POST['email'];
	$password  = $_POST['password'];
	$mobile    = $_POST['mobile'];
  $restaurant_name = $_POST['restaurant_name'];
	//$date      = date('Y-m-d H:i:s');
  //$stafftype = $_POST['staff'];
  // $Caddress  = $_POST['Caddress'];
  // $Paddress  = $_POST['Paddress'];
 
	$qry = "UPDATE `tbl_admin` SET `user_fullname`= '$fullname',`user_username`='$username',`user_email`= '$email',`user_password`= '$password',`mobile_no`= '$mobile',`restaurant_name` = '$restaurant_name' WHERE `user_id` = $admin_id";
	//echo $qry;exit;
	$run = mysqli_query($conn,$qry);
	if($run == TRUE)
	{
		header("location:admin.php");
	}

}
?>

<!DOCTYPE html>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Restaurant</span></a>
            </div>

            <div class="clearfix"></div>

            
           <?php include 'sidemenu.php';?>
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $username;?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profile</a>
                      <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                  <a class="dropdown-item"  href="javascript:;">Help</a>
                    <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
                      <div class="clearfix"></div>
             <form method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      
                     <?php $query = "SELECT * FROM tbl_admin WHERE user_id = $admin_id";
                    // echo $query;exit;
                     $runqry = mysqli_query($conn,$query);
                     $data   = mysqli_fetch_array($runqry);?>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"><b>Full Name</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="first-name" value="<?php echo $data['user_fullname'];?>" name="fullname" required="required" class="form-control ">
                        </div>
                      </div>
                     
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Username </b><span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="middle-name" class="form-control" value="<?php echo $data['user_username'];?>" name="username" type="text" required="required">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Mobile</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="mobile" class="form-control" onBlur="checkusernameAvailability()" name="mobile" min="0" oninput="validity.valid||(value='');" value="<?php echo $data['mobile_no'];?>" required="required" type="number">
                        </div>
                         <span id="username-availability-status"></span>
                      </div>
                     <!--  <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                        <div class="col-md-6 col-sm-6 ">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="female" class="join-btn"> Female
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"></b>Email </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="email" value="<?php echo $data['user_email'];?>" required="required" type="email">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Password</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="password" class="form-control" value="<?php echo $data['user_password'];?>" name="password" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Restaurant Name </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="restaurant_name" class="form-control" value="<?php echo $data['restaurant_name'];?>" name="restaurant_name" required="required" type="text">
                        </div>
                      </div>
                              
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-primary" onclick="window.location.href='<?php echo "admin.php"; ?>';" type="button">Cancel</button>
						                <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit" name="register" id="register" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </form>

            </div>
                     <script>

function checkusernameAvailability() {
  //alert("pankaj");
jQuery.ajax({
url: "../Ajax/check_availability.php",
data:'mobile='+$("#mobile").val(),
type: "POST",
success:function(data){
if(data !='0')
{
$('#username-availability-status').html('<span class="text-danger">Mobile not available</span>');
$('#register').attr("disabled",true);
}
else
{
$('#username-availability-status').html('<span class="text-success">Mobile available</span>');
$('#register').attr("disabled",false);

}
},
});
}

</script>
        <!-- /page content -->

        <!-- footer content -->
  <?php include 'footer.php';?>
