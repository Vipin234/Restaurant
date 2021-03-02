<?php
include '../config.php';
include 'header.php';
session_start();
$userid   = $_SESSION['userid'];
$adminid = $_SESSION['adminid']; 
$userrole = $_SESSION['userrole'];
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$staff_id = $_GET['id'];
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
  $aadhar_no = $_POST['aadhar_no'];
  $pan_no    = $_POST['pan_no'];
  $gender    = $_POST['gender'];
	$mobile    = $_POST['mobile'];
	$date      = date('Y-m-d H:i:s');
  $stafftype = $_POST['staff'];
  $desgn     = $_POST['staff'];
  $Caddress  = $_POST['Caddress'];
  $Paddress  = $_POST['Paddress'];
  $dob1      = $_POST['dob'];
  $dob       = date('d/m/Y',strtotime($dob1));
 
	$qry = "UPDATE `tbl_restaurant_staff_registration` SET `admin_id` = '$adminid',`name`= '$fullname',`username`='$username',`email`= '$email',`password`= '$password',`date_of_birth` = '$dob',`aadhar_no` = '$aadhar_no',`pan_number` = '$pan_no',`gender` = '$gender',`mobile_no`= '$mobile',`current_address` = '$Caddress',`permanent_address` = '$Paddress',`modified_date`='$date',`user_type`='$stafftype',`desingination`='$desgn' WHERE `id` = $staff_id";
	//echo $qry;exit;
	$run = mysqli_query($conn,$qry);
	if($run == TRUE)
	{
		header("location:stafflist.php");
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
                      
                     <?php $query = "SELECT * FROM tbl_restaurant_staff_registration WHERE id = $staff_id";
                    // echo $query;exit;
                     $runqry = mysqli_query($conn,$query);
                     $data   = mysqli_fetch_array($runqry);?>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"><b>Full Name</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="first-name" value="<?php echo $data['name'];?>" name="fullname" required="required" class="form-control ">
                        </div>
                      </div>
                     
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Username</b><span class="required">*</span>
</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="middle-name" class="form-control" value="<?php echo $data['username'];?>" name="username" type="text">
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
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Email</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="email" value="<?php echo $data['email'];?>" required="required" type="email">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Password</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="password" class="form-control" value="<?php echo $data['password'];?>" name="password" required="required" type="text">
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Date of Birth</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <?php $date = $data['date_of_birth'];$dob = date("Y-m-d",strtotime($date))?>
                          <input id="dob" class="form-control" name="dob" required="required" type="date" value="<?php echo $dob; ?>">
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Aadhar Number</b>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="aadhar_no" class="form-control" name="aadhar_no" type="text" value="<?php echo $data['aadhar_no'];?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Pan Number</b>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="pan_no" class="form-control" name="pan_no" type="text" value="<?php echo $data['pan_number'];?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Gender</b> <span class="required">*</span></label>
                      <div class="form-check-inline col-md-2" id="fixed">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="gender" value="male" <?php if($data['gender'] == 'male'){ echo "checked";}?>><b>Male</b>
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3" id="half_full">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="gender" value="female" <?php if($data['gender'] == 'female'){ echo "checked";}?>><b>Female</b>
                       </label>
                     </div>
                     </div> 
                     
                               <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Current Address</b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea id="address" class="form-control" name="Caddress"  required="required" type="textarea"><?php echo $data['current_address'];?></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Permanent Address</b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea id="address" class="form-control" name="Paddress" required="required" type="textarea"><?php echo $data['permanent_address'];?></textarea>
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Staff Type</b> <span class="required">*</span>
                        </label>
                        <div class="form-group col-md-6 col-sm-6 ">

      <select class="form-control" id="sel1" name="staff" required="required">
        <option value="">Please select any one</option>
        <option name="staff" value="Supervisor" <?php if($data['user_type'] == 'Supervisor') { ?> selected="selected"<?php } ?>>Supervisor</option>
        <option name="staff" value="KOT" <?php if($data['user_type'] == 'KOT') { ?> selected="selected"<?php } ?>>KOT</option>
        <option name="staff" value="Chef" <?php if($data['user_type'] == 'Chef') { ?> selected="selected"<?php } ?>>Chef</option>
        <option name="staff" value="Waiter" <?php if($data['user_type'] == 'Waiter') { ?> selected="selected"<?php } ?>>Waiter</option>





      </select>
                      </div>
                    </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-primary" onclick="window.location.href='<?php echo "stafflist.php"; ?>';" type="button">Cancel</button>
						                <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit" id="register" name="register" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </form>
            </div>
                     <script>

function checkusernameAvailability() {
  //alert("pankaj");
jQuery.ajax({
url: "../Ajax/check_mobile.php",
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
