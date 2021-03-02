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
date_default_timezone_set('Asia/Kolkata'); 
if(isset($_POST['create'])){
//  echo "pankaj";
  $menu_name      = $_POST['menu_name'];
  $menu_detail    = $_POST['menu_detail'];
  //echo $menu_detail;exit;
  $food_type      = $_POST['food_type'];
  $menu_price     = $_POST['menu-price'];
  $half_price     = $_POST['half-price'];
  $full_price     = $_POST['full-price'];
  //echo $menu_price;exit;
  //echo $menu_price."<br>".$half_price."<br>".$full_price;exit;
  $price          = $_POST['price'];
  $image          = $_FILES['image']['name'];
  $image1 = base64_encode($image);
  $tmpimage       = $_FILES['image']['tmp_name'];
  move_uploaded_file($tmpimage,"../Menu_images/$image");
  $date           = date('Y-m-d H:i:s');
  /*$qry = "INSERT INTO `tbl_restaurant_menu_item_list`(`admin_id`, `menu_food_type`, `menu_name`, `menu_image`, `menu_detail`, `menu_fix_price`, `create_date`,`status`) VALUES ('$adminid','$food_type','$menu_name','$image1','$menu_detail','$price','$date',1)";*/
  if($menu_price == 'fixedPrice')
  {
  $qry = "INSERT INTO `tbl_restaurant_menu_item_list`(`admin_id`, `menu_food_type`,`menu_price_type`, `menu_name`, `menu_image`, `menu_detail`, `menu_fix_price`, `create_date`,`status`) VALUES ('$adminid','$food_type','$menu_price','$menu_name','$image1','$menu_detail','$price','$date',1)";
  }
  elseif($menu_price == 'half-fullPrice')
  {
    $qry = "INSERT INTO `tbl_restaurant_menu_item_list`(`admin_id`, `menu_food_type`,`menu_price_type`, `menu_name`, `menu_image`, `menu_detail`, `menu_half_price`,`menu_full_price`, `create_date`,`status`) VALUES ('$adminid','$food_type','$menu_price','$menu_name','$image1','$menu_detail','$half_price','$full_price','$date',1)";
  }
  //echo $qry;exit;
  $run = mysqli_query($conn,$qry);
  $id = mysqli_insert_id($conn);
      $alphanumerric='MENU_0000'.$id;
  if($run == TRUE)
  {
    $data="UPDATE tbl_restaurant_menu_item_list SET menu_id='$alphanumerric' where id='$id'";
        $insertdata=mysqli_query($conn,$data);
    header("location:restaurant_menu.php");
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
             <form method="post" action="" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      
                     
                      <!-- <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="first-name" name="firstname" required="required" class="form-control ">
                        </div>
                      </div> -->
                      
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name"><b>Menu Name</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="full-name" name="menu_name" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Menu Details</b> <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="middle-name" class="form-control" name="menu_detail" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Food Type</b> <span class="required">*</span></label>
                      <div class="form-check-inline col-md-2">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" value="veg" name="food_type"><b>Veg</b>
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="food_type" value="non-veg"><b>Non-Veg</b>
                       </label>
                     </div>
                     </div>

                       <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Menu Price </b><span class="required">*</span></label>
                      <div class="form-check-inline col-md-2" id="fixed">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="menu-price" value="fixedPrice"><b>Fixed</b>
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3" id="half_full">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="menu-price" value="half-fullPrice"><b>Half & Full</b>
                       </label>
                     </div>
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
                      <div id="fixed-price">
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Price</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="price" type="number">
                        </div>
                      </div>
                    </div>
                       <div id="price" style="">
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Half Price</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="half-price" type="number">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Full Price</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="full-price" type="number">
                        </div>
                      </div>
                    </div>  
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Image </b><span class="required">*</span>
                        </label>
                         <div class="form-group col-md-6 col-sm-6">
                          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                      </div>
                      
                     
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-primary" onclick="window.location.href='<?php echo "restaurant_menu.php"; ?>';" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" name="create" class="btn btn-success">Create</button>
                        </div>
                      </div>

                    </form>

            </div>
           
<!--                      <script>

function checkusernameAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "../Ajax/check_mobile.php",
data:'mobile='+$("#mobile").val(),
type: "POST",
success:function(data){
$("#username-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script> -->
        <!-- /page content -->

        <!-- footer content -->
  <?php include 'footer.php';?>
     <script type="text/javascript">
             $(function () {
           $("input[name=menu-price]:radio").click(function () {

        if ($('input[name=menu-price]:checked').val() == "fixedPrice") {
            $('#price').css("display","none");
            $('#fixed-price').css("display","block");

        } else if ($('input[name=menu-price]:checked').val() == "half-fullPrice") {
            $('#price').css("display","block");
            $('#fixed-price').css("display","none");

        }
    });
});

            </script>
 