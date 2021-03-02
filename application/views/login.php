
<!DOCTYPE html>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  <style type="text/css">
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
  -moz-appearance: textfield;
}
    </style>

  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="">
              <h1>Login Form</h1>
              
              <div class="form-group">
      <label for="sel1">Select Type</label>
      <select class="form-control" id="sel1" name="usertype">
        <option name="usertype" value="">--Please select any--</option>
        <option name="usertype" value="admin">Admin</option>
        <option name="usertype" value="supervisor">Supervisor</option>
      </select>
    </div>
    <br>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username Or Mobile" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <!-- <a class="btn btn-default submit" name="submit" href="#">Log in</a> -->
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!-- <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div> -->
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" action="register_admin.php">
              <h1>Create Account</h1>
              <div>
                <input type="text" name="user_fullname" class="form-control" placeholder="User fullname" required="" />
              </div>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" onBlur="checkusernameAvailability()" required="" min="0" oninput="validity.valid||(value='');"/>
<span id="username-availability-status"></span>
              </div>

<br>
               <div>
                <input type="text" class="form-control" name="restaurant_name" placeholder="Restaurant Name" required="" />
              </div>
              <div>
               <a><button type="submit" name="register" id="register" class="btn btn-primary">Register</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

              
              </div>
            </form>
          </section>
        </div>
      </div>
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
  </body>
</html>
