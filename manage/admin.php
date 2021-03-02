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
           <button id="exportButton" class="btn btn-danger clearfix"><span class="fa fa-file-excel-o"></span> Export to Excel</button>
             <!-- <?php// if($usertype == 'superadmin')
             { $display// = "none"; }
            // elseif($usertype == "admin")
              { $display// = ""; }?>
             <div class="pull-right" style="display:<?php //echo $display;?>"> -->
              <div class="pull-right">
              <input class="btn btn-primary" type="button" name="addsiteuser" value="Add Admin"
                onclick="window.location.href='<?php echo "addadmin.php"; ?>';"/>
            </div>
                 <?php $qry = "SELECT * FROM tbl_admin WHERE user_type !='superadmin' AND user_active = 1";
                 $run = mysqli_query($conn,$qry);?>
             <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <!-- <th>Usertype</th> -->
                          <th>Restaurant</th>
                          <th>Create Date</th>
                          <th>Edit/Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($fetchdata = mysqli_fetch_array($run)){
                        ?>
                        <tr>
                          <td><?php echo $fetchdata['user_fullname'];?></td>
                          <td><?php echo $fetchdata['user_username'];?></td>
                          <td><?php echo $fetchdata['user_email'];?></td>
                          <td><?php echo $fetchdata['mobile_no'];?></td>
                          <!-- <td><?php// echo $fetchdata['user_type'];?></td> -->
                          <td><?php echo $fetchdata['restaurant_name'];?></td>
                          <td><?php echo $fetchdata['user_createdate'];?></td>
                           <td><a href="editadmin.php?id=<?php echo $fetchdata['user_id']?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>  <a href="deleteadmin.php?id=<?php echo $fetchdata['user_id']?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                          
                        </tr>
                      <?php } ?>
                       
                      </tbody>
                    </table>
          
     
            </div>
         
        <!-- /page content -->

        <!-- footer content -->
  <?php include 'footer.php';?>
   <script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#datatable-responsive",
                schema: {
                    type: "table",
                    fields: {
                        FullName: { type: String },
                        Username: { type: String },
                        Email: { type: String },
                        Mobile: { type: Number },
                        Usertype: { type: String },
                        Restaurant: { type: String },
                        Create_Date: { type: Date }
                    }
                }
            });

            // when parsing is done, export the data to Excel
            dataSource.read().then(function (data) {
                new shield.exp.OOXMLWorkbook({
                    author: "PrepBootstrap",
                    worksheets: [
                        {
                            name: "PrepBootstrap Table",
                            rows: [
                                {
                                    cells: [
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Full name"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Username"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Email"
                                        },
                                                                                {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Mobile"
                                        },
                                                                                {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Usertype"
                                        },
                                                                                {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Restaurant"
                                        },
                                                                                {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Create_Date"
                                        },
                                    ]
                                }
                            ].concat($.map(data, function(item) {
                                return {
                                    cells: [
                                        { type: String, value: item.FullName },
                                        { type: String, value: item.Username },
                                        { type: String, value: item.Email },
                                        { type: Number, value: item.Mobile },
                                        { type: String, value: item.Usertype },
                                        { type: String, value: item.Restaurant },
                                        { type: Date, value: item.Create_Date }
                                    ]
                                };
                            }))
                        }
                    ]
                }).saveAs({
                    fileName: "admin_list"
                });
            });
        });
    });
</script>


<style>
    #exportButton {
        border-radius: 0;
    }
</style>
