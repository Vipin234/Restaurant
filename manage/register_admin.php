<?php
/*$code = "1234567890";
	$password = substr( str_shuffle( $code ), 0, 5);
	echo $password;
	exit(); 	*/
include '../config.php';
$msg = '';
if(isset($_POST['varify']))
{
	$otp = $_POST['varify_otp'];
  //$mobile_no = $_POST['mobile_no'];
 // echo $mobile_no;exit;
	$query = "SELECT * FROM tbl_otp_admin WHERE otp = '$otp'";
 // echo $query;exit;
	$runquery = mysqli_query($conn,$query);
	if(mysqli_num_rows($runquery)>0)
	{
		/*$command = "UPDATE tbl_admin SET user_active = 1 WHERE mobile_no = '$mobile_no'";
    $runquery1 = mysqli_query($conn,$command);*/
    echo "<script>
alert('You have successfully registered');
window.location.href='login.php';
</script>";
   /* echo '<script type="text/javascript">alert("You have successfully registered")</script>';*/
		/*header("location:login.php");*/
	}
	else
	{
		/*$msg  = "Otp does not matched";*/
     echo "<script>
alert('Invalid OTP');
window.location.href='register_admin.php';
</script>";
	}
}
date_default_timezone_set('Asia/Kolkata'); 
if(isset($_POST['register']))
{
	$fullname = $_POST['user_fullname'];
	$username = $_POST['username'];
	$email    = $_POST['email'];
	$password = $_POST['password'];
	$mobile   = $_POST['mobile'];
	$restaurant = $_POST['restaurant_name'];
  $date     = date('Y-m-d H:i:s');
  $usertype = 'admin';

	$qry = "INSERT INTO `tbl_admin`(`user_fullname`, `user_username`, `user_email`, `user_password`,`user_active`,`user_createdate`,`user_type`, `mobile_no`,`restaurant_name`) VALUES ('$fullname','$username','$email','$password',1,'$date','$usertype','$mobile','$restaurant')";
	//echo $qry;
	$run = mysqli_query($conn,$qry);
	 $id = mysqli_insert_id($conn);
      $alphanumerric='ADMIN_0000'.$id;
if($run)
{
	    $data="UPDATE tbl_admin SET admin_id='$alphanumerric' where user_id='$id'";
        $insertdata=mysqli_query($conn,$data);
	$code     = "1234567890";
	$otp = substr( str_shuffle( $code ), 0, 4);
  $date1 = date('Y-m-d H:i:s');
	//echo $otp;
	$query = "INSERT INTO `tbl_otp_admin`(`mobile_no`, `otp`, `status`,`create_date`) VALUES ('$mobile',$otp,1,'$date1')";
	//echo
	$runcode = mysqli_query($conn,$query);
	$url     = 'https://2factor.in/API/V1/c43867a9-ba7e-11e9-ade6-0200cd936042/SMS/'.$mobile.'/'.$otp.'/'.'OTP'.'';
	/*echo $url;exit;
}*/
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
/*if($url)
{
	echo "msg send successfully";
}
else
{
	echo "error";
}*/

/*if($url)
{
	echo "msg send successfully";
}
else
{
	echo "error";
}*/

}
}
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login" style="font-size:0px;">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form" style="background-color: white;height: 227px;width: 409px;">
          <section class="login_content">
            <form method="post" action="">
              <!-- <div class="alert alert-primary"><?php //echo $msg;?></div> -->
              <div style="width: 283px;margin-left: 68px;">
                <!-- <input type="hidden" name="mobile_no" value="<?php //echo $mobile;?>"> -->
                <input type="text" name="varify_otp" class="form-control" placeholder="Verify OTP" required="" />
              </div>
             
              <div>
                <button type="submit" name="varify" class="btn btn-primary">Verify</button>
                <!-- <a class="btn btn-default submit" name="submit" href="#">Log in</a> -->
               </div>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
  </html>


