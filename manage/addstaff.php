<?php
include '../config.php';
include 'header.php';
session_start();
$userid   = $_SESSION['userid'];
$adminid  = $_SESSION['adminid'];
$userrole = $_SESSION['userrole'];
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
if($adminid == '')
{
  header("location:login.php");
}
//echo $usertype;exit;
//echo $adminid;exit;
date_default_timezone_set('Asia/Kolkata'); 
if(isset($_POST['register'])){
//	echo "pankaj";
	$fullname = $_POST['fullname'];
	//$lastname  = $_POST['lastname'];
	//echo $lastname;exit;
	$username  = $_POST['username'];
	$email     = $_POST['email'];
	$password  = $_POST['password'];
  $aadhar_no = $_POST['aadhar_no'];
  $pan_no    = $_POST['pan_no'];
  $gender    = $_POST['gender'];
	$mobile    = $_POST['mobile'];
  $caddress  = $_POST['Caddress'];
  $paddress  = $_POST['Paddress'];
  $dob1       = $_POST['dob'];
  $dob       = date("d/m/Y",strtotime($dob1));
	$date      = date('Y-m-d H:i:s');
  $stafftype = $_POST['staff'];
 $desgn = $_POST['staff'];

	$qry = "INSERT INTO `tbl_restaurant_staff_registration`(`admin_id`,`name`,`username`, `mobile_no`, `email`, `password`,`date_of_birth`,`aadhar_no`,`pan_number`,`desingination`,`gender`, `current_address`, `permanent_address`, `user_type`,`create_date`,`status`) VALUES ('$adminid','$fullname','$username','$mobile','$email','$password','$dob','$aadhar_no','$pan_no','$desgn','$gender','$caddress','$paddress','$stafftype','$date',1)";
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
                      
                     
                      <!-- <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="first-name" name="firstname" required="required" class="form-control ">
                        </div>
                      </div> -->
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name"><b>Full Name </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="full-name" name="fullname" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Username </b><span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="middle-name" class="form-control" name="username" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Mobile </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="mobile" class="form-control" onBlur="checkusernameAvailability()" name="mobile" min="0" oninput="validity.valid||(value='');" required="required" type="number">
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
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Email </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="email" required="required" type="email">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Password</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="password" class="form-control" name="password" required="required" type="password">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Date of Birth </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="dob" class="form-control" name="dob" required="required" type="date">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Aadhar Number </b><!-- <span class="required">*</span> -->
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="aadhar_no" class="form-control" name="aadhar_no" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Pan Number</b> <!-- <span class="required">*</span> -->
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="pan_no" class="form-control" name="pan_no" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Gender</b> <span class="required">*</span></label>
                      <div class="form-check-inline col-md-2" id="fixed">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="gender" value="male"><b>Male</b>
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3" id="half_full">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="gender" value="female"><b>Female</b>
                       </label>
                     </div>
                     </div> 
                     
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Current Address</b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea id="address" class="form-control" name="Caddress" required="required" type="textarea"></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Permanent Address</b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea id="address" class="form-control" name="Paddress" required="required" type="textarea"></textarea>
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Staff Type </b><span class="required">*</span>
                        </label>
                        <div class="form-group col-md-6 col-sm-6 ">

      <select class="form-control" id="sel1" name="staff" required="required">
        <option value="">Please select any one</option>
                                  <?php if($usertype == "Supervisor"){
                                   $qry = "SELECT * FROM tbl_stafftype WHERE staff_name != 'Supervisor'";
                                 }else
                                 {
                                  $qry = "SELECT * FROM tbl_stafftype";
                                 }
                          $run  = mysqli_query($conn,$qry);
                          while($data = mysqli_fetch_array($run)){?>
        <option name = "staff" value="<?php echo $data['staff_name'];?>"><?php echo ucfirst($data['staff_name']);?></option>
       <?php }?>
      </select>
                      </div>
                    </div>
                     
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-primary" onclick="window.location.href='<?php echo "stafflist.php"; ?>';" type="button">Cancel</button>
						                <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" id="register" name="register" class="btn btn-success">Submit</button>
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
