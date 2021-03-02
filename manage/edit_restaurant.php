<?php
include '../config.php';
include 'header.php';
session_start();
$userid   = $_SESSION['userid'];
$adminid  = $_SESSION['adminid'];
$userrole = $_SESSION['userrole'];
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$restaurant_id = $_GET['restaurant_id'];
//echo $restaurant_id;exit;
if($adminid == '')
{
  header("location:login.php");
}

date_default_timezone_set('Asia/Kolkata'); 
if(isset($_POST['create'])){
  $city_name = $_POST['city_name'];
  $rname      = $_POST['restaurant_name'];
  $location  = $_POST['location'];
  $address = str_replace(" ", " ", $location);
  $key = "AIzaSyBFopKombxX7GqBDEh4eo0RTgEtxkANLis";
  $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=true&key={$key}");
  $json = json_decode($json);
  // print($json);exit;
  $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
  $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
  $phone                   =$_POST['phone'];
  $adress                  =$_POST['address'];
  $amenity                 =$_POST['amenities'];
  $amenities               =implode(',',$amenity);
  $open_time               =$_POST['opening_time'];
  $opening_time            =date('g:ia',strtotime($open_time));
  $close_time              =$_POST['closing_time'];
  $closing_time            =date('g:ia',strtotime($close_time));
  $gst_no                  =$_POST['gst_no'];
  $updated_date            =date('Y-m-d H:i:s');
  $name                    =$_FILES['image']['name'];
  $size                    =$_FILES['image']['size'];
  $tmp_name                =$_FILES['image']['tmp_name'];
  $t                       =time()."".date('Ymd');
  $img_name                ='resto'."_".$t.".jpeg";
  move_uploaded_file($tmp_name,"../uploads/".$img_name);

  $qry = "UPDATE spots SET city = '$city_name',name = '$rname',image = '$img_name',lat = '$lat',lng = '$long',location = '$address',openingTime = '$opening_time',closingTime = '$closing_time',phone = '$phone',address = '$adress',amenities = '$amenities',`gst_no` = '$gst_no',modified_date = '$updated_date' WHERE spotId = '$restaurant_id'";
  // echo $qry;exit;
  $run = mysqli_query($conn,$qry);
  if($run == TRUE)
  {
    $sqlQuery=mysqli_query($conn,"SELECT image from spots where spotId = '$restaurant_id'");
    $fetch=mysqli_fetch_assoc($sqlQuery);
    $oldImage=$fetch['image'];
    
    unlink('http://'.$_SERVER['SERVER_NAME'].'/Restaurant/uploads'.'/'.$fetch['image']);

    header("location:restaurant.php");
  }

}
?>

<!DOCTYPE html>
 <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    </head>
  <body class="nav-md">

 <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBFopKombxX7GqBDEh4eo0RTgEtxkANLis&callback=initMap" async defer></script>
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
                      <?php
                      $qry1 = "SELECT * FROM spots WHERE spotId = '$restaurant_id'";
                      $run1 = mysqli_query($conn,$qry1);
                      $fetch = mysqli_fetch_array($run1);
                      $checkbox_array = explode(",", $fetch['amenities']);
                      ?>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name"><b>City</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="full-name" value="<?php echo $fetch['city'];?>" name="city_name" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name"><b>Restaurant Name </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="full-name" name="restaurant_name" value="<?php echo $fetch['name'];?>" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Restaurant Location</b><span class="required">*</span>
</label>
                        <div class="col-md-6 col-sm-6 ">
                          <!-- <input id="middle-name" class="form-control" name="location" type="text"> -->
                          <input id="searchInput" class=" form-control controls"  name="location" type="text" value="<?php echo $fetch['location'];?>" placeholder="Enter a location">
                          <div id="map"></div>
                            
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Restaurant Phone </b><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="mobile" class="form-control" onBlur="checkusernameAvailability()" name="phone" value="<?php echo $fetch['phone'];?>" required="required" type="text">
                        </div>
                         <span id="username-availability-status"></span>
                      </div>
                    
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Restaurant Address</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="email" class="form-control" name="address" value="<?php echo $fetch['address'];?>" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"><b>Amenities </b></label>
                      <div class="form-check-inline col-md-2">
                       <label class="form-check-label">
                         <input type="checkbox" class="form-check-input" value="WiFi" name="amenities[]" <?php if(in_array("WiFi", $checkbox_array)){ echo " checked=\"checked\""; } ?>><b>WiFi</b>
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3">
                       <label class="form-check-label">
                         <input type="checkbox" class="form-check-input" name="amenities[]" <?php if(in_array("Free Parking", $checkbox_array)){ echo " checked=\"checked\""; } ?> value="Free Parking"><b>Free Parking</b>
                       </label>
                     </div>
                     <div class="form-check-inline col-md-3">
                       <label class="form-check-label">
                         <input type="checkbox" class="form-check-input" name="amenities[]" <?php if(in_array("Playground", $checkbox_array)){ echo " checked=\"checked\""; } ?> value="Playground"><b>Playground</b>
                       </label>
                     </div>
                     </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Opening Time</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <?php $time = $fetch['openingTime'];
                          $openingTime = date('H:i',strtotime($time));?>
                          <input id="opening_time" class="form-control" name="opening_time" value="<?php echo $openingTime;?>" type="time" required="required">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Closing Time</b> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                                                  <?php $time = $fetch['closingTime'];
                          $closingTime = date('H:i',strtotime($time));?>
                          <input id="closing_time" class="form-control" name="closing_time" value="<?php echo $closingTime;?>" type="time" required="required">
                        </div>
                      </div>
                     <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Restaurant GST Number</b>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input id="gst_no" class="form-control" name="gst_no" value="<?php echo $fetch['gst_no'];?>"  type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"><b>Image</b> <span class="required">*</span>
                        </label>
                         <div class="form-group col-md-6 col-sm-6">
                          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" required="required">
                        </div>
                      </div>
                     
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button class="btn btn-primary" onclick="window.location.href='<?php echo "stafflist.php"; ?>';" type="button">Cancel</button>
                            <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit" name="create" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </form>

            </div>
                     <!-- <script>

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
 <script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        // Location details
        for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
                document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
        }
        document.getElementById('location').innerHTML = place.formatted_address;
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lon').innerHTML = place.geometry.location.lng();
    });
}
</script>
        <!-- /page content -->

        <!-- footer content -->
  <?php include 'footer.php';?>
