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
//  echo "pankaj";
  $category = $_POST['category'];
/*  $lastname  = $_POST['lastname'];*/
  //echo $lastname;exit;
  
  
    header("location:send_notification.php?mobile_no=$category");
  

}
?>

<!DOCTYPE html>
 <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

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
              <div class="col-md-12 col-sm-12 col-xs-12" id="ecommerce-product-add">
           <div class="left_col" role="main">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 
                  <div class="x_content">
            <div class="fl_window">
               <!--  <div><img src="http://api.androidhive.info/images/firebase_logo.png" width="200" alt="Firebase"/></div> -->
                <br/>
                <?php if ($json != '') { ?>
                    <label><b>Request:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($json) ?></pre>
                    </div>
                <?php } ?>
                <br/>
                <?php if ($response != '') { ?>
                    <label><b>Response:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($response) ?></pre>
                    </div>
                <?php } ?>

            </div>

            <form class="pure-form pure-form-stacked" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Send to Single Device</legend>

                    <label for="redId">Firebase Reg Id</label>
                    <input type="text" id="redId" readonly name="regId" class="pure-input-1-2" placeholder="Enter firebase registration id" value="<?php echo $notification_id; ?>">

                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="pure-input-1-2" placeholder="Enter title">

                    <label for="message">Message</label>
                    <textarea class="pure-input-1-2" rows="5" name="message" id="message" placeholder="Notification message!"></textarea>
 

                    <label for="include_image" class="pure-checkbox">
                        <input name="include_image" id="include_image" type="checkbox"> Include image
                    </label>
                    <input type="hidden" name="push_type" value="individual"/>
                    <button type="submit" name="submit" class="pure-button pure-button-primary btn_send">Send</button>
                </fieldset>
            </form>
            <br/><br/><br/><br/>

            <form class="pure-form pure-form-stacked" method="get">
                <fieldset>
                    <legend>Send to Topic `global`</legend>

                    <label for="title1">Title</label>
                    <input type="text" id="title1" name="title" class="pure-input-1-2" placeholder="Enter title">

                    <label for="message1">Message</label>
                    <textarea class="pure-input-1-2" name="message" id="message1" rows="5" placeholder="Notification message!"></textarea>

                    <label for="include_image1" class="pure-checkbox">
                        <input id="include_image1" name="include_image" type="checkbox"> Include image
                    </label>
                    <input type="hidden" name="push_type" value="topic"/>
                    <button type="submit" class="pure-button pure-button-primary btn_send">Send to Topic</button>
                </fieldset>
            </form>
        </div>
                </div>
              </div>
            </div>
          </div>
                  

                    </form>
            </div>
                     <script>

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
</script>
        <!-- /page content -->

        <!-- footer content -->
  <?php include 'footer.php';?>
