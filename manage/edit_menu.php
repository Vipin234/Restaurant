<?php
include '../config.php';
include 'header.php';
session_start();
$userid   = $_SESSION['userid'];
$adminid  = $_SESSION['adminid']; 
$userrole = $_SESSION['userrole'];
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$menu_id  = $_GET['id'];
if($adminid == '')
{
  header("location:login.php");
}
//echo $staff_id;exit;
date_default_timezone_set('Asia/Kolkata'); 
if(isset($_POST['update'])){
  $menu_name      =$_POST['menu_name'];
  $menu_detail    =$_POST['menu_detail'];
  $food_type      =$_POST['food_type'];
  $menu_price     =$_POST['menu-price'];
  $half_price     =$_POST['half-price'];
  $full_price     =$_POST['full-price'];
  $price          =$_POST['price'];
  $name           =$_FILES['image']['name'];
  $size           =$_FILES['image']['size'];
  $tmp_name       =$_FILES['image']['tmp_name'];
  $t              =time()."".date('Ymd');
  $image          ='menu'."_".$t.".jpeg";
  move_uploaded_file($tmp_name,"../uploads/".$image);

 if($menu_price == 'fixedPrice')
  {
  $qry = "UPDATE `tbl_restaurant_menu_item_list` SET `menu_name`= '$menu_name',`menu_image` = '$image',`menu_food_type`='$food_type',`menu_price_type`='$menu_price',`menu_detail`= '$menu_detail',`menu_fix_price`= '$price',`menu_half_price`= '$half_price',`menu_full_price`='$full_price' WHERE `id` = $menu_id";
  }
  elseif($menu_price == 'half-fullPrice')
  {
     $qry = "UPDATE `tbl_restaurant_menu_item_list` SET `menu_name`= '$menu_name',`menu_image` = '$image',`menu_food_type`='$food_type',`menu_price_type`='$menu_price',`menu_detail`= '$menu_detail',menu_fix_price='$price',`menu_half_price`= '$half_price',`menu_full_price`='$full_price' WHERE `id` = $menu_id";
  }
  // echo $qry;exit;
  $run = mysqli_query($conn,$qry);
  if($run == TRUE)
  {
    header("location:restaurant_menu.php");
  }

}
?>
<!DOCTYPE html>

  <body class="nav-md">l
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
                      <?php $query = "SELECT * FROM tbl_restaurant_menu_item_list WHERE id = '$menu_id'";
                      $runqry = mysqli_query($conn,$query);
                      $fetch = mysqli_fetch_array($runqry);
                      ?>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Menu Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="full-name" name="menu_name" value="<?php echo $fetch['menu_name']?>" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Menu Details <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="middle-name" class="form-control" name="menu_detail" value="<?php echo $fetch['menu_detail']?>" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Food Type <span class="required">*</span></label>
                      <div class="form-check-inline col-md-2">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" value="veg" <?php if($fetch['menu_food_type'] == 'veg'){ echo "checked";}?> name="food_type">Veg
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="food_type" value="non-veg" <?php if($fetch['menu_food_type'] == 'non-veg'){ echo "checked";}?>>Non-Veg
                       </label>
                     </div>
                     </div>

                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Menu Price <span class="required">*</span></label>
                      <div class="form-check-inline col-md-2" id="fixed">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="menu-price" value="fixedPrice" <?php if($fetch['menu_price_type'] == 'fixedPrice'){ echo "checked";}?>>Fixed
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3" id="half_full">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" name="menu-price" value="half-fullPrice" <?php if($fetch['menu_price_type'] == 'half-fullPrice'){ echo "checked";}?>>Half & Full
                       </label>
                     </div>
                     </div>
                      
                   
                      <div id="fixed-price">
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="" class="form-control" name="price" value="<?php echo $fetch['menu_fix_price']?>" type="number">
                        </div>
                      </div>
                    </div>
                       <div id="price" style="">
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Half Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="half-price" value="<?php echo $fetch['menu_half_price']?>" type="number">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Full Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="full-price" value="<?php echo $fetch['menu_full_price']?>" type="number">
                        </div>
                      </div>
                    </div> 
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Image <span class="required">*</span>
                        </label>
                         <div class="form-group col-md-6 col-sm-6">
                          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                          <img src="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Restaurant/uploads'.'/'.$fetch['menu_image']; ?>" height="80px" width="120px"/>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-primary" onclick="window.location.href='<?php echo "restaurant_menu.php"; ?>';" type="button">Cancel</button>
                            <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit" name="update" class="btn btn-success">Update</button>
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
