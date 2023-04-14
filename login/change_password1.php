<?php
session_start();
include 'connection.php';
$e=$_SESSION['mail'];
if(isset($_POST['submit']))
{
	$pass = md5($_POST['pass']);
	$con_pass = md5($_POST['con_pass']);
	if($pass==$con_pass)
	{
		$sql = "UPDATE tbl_user SET password='$pass' WHERE email_id='$e'";

        if (mysqli_query($conn,$sql)) {
            session_destroy();
                    echo "<script type=\"text/javascript\">".
            "alert('PASSWORD Change Successfully');".
            "</script>";?>
            <script type="text/javascript">
                window.setTimeout(function() {
                    window.location.href='login.php';
                }, 500);
            </script>
        <?php
        }

        }
        else
        {
            echo "<script type=\"text/javascript\">".
                                "alert('Confirm password not matched...');".
                                    "</script>";
        }
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Change Password</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords"
		content="Working Signin form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <!-- //Meta tag Keywords -->
	<link href="//fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
	<!--/Style-CSS -->
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
	<!--//Style-CSS -->
    <style>
        .center{
            text-align: left;
        }
    </style>
</head>

<body>

	 <!-- form section start -->
	 <section class="w3l-workinghny-form " >
        <!-- /form -->
        <div class="workinghny-form-grid">
            <div class="wrapper">
                <div class="logo">
                    <h1><a class="brand-logo" style="pointer-events:none;"> Change Password  </a></h1>
                    <!-- if logo is image enable this   
                        <a class="brand-logo" href="#index.html">
                            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                        </a> -->
                </div>
                <div class="workinghny-block-grid">
                    <div class="workinghny-left-img align-end">
                        <img src="2.png" class="img-responsive" alt="img" />
                    </div>
                    <div class="form-right-inf">
						
                        <div class="login-form-content">
                            <form class="signin-form" method="post">
								<div class="one-frm">

									<label>Password</label>
									<input type="password" name="pass" id="pass" placeholder="Enter Password" required="">
								</div>
								<div class="one-frm">
									<label>Confirm Password</label>
									<input type="password" name="con_pass" id="pass2" placeholder="Enter Confirm Password" required="">
                                </div>
                                <button type="submit" class="btn btn-style mt-3 w3-theme-d2" name="submit">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //form -->
    </section>
    <!-- //form section start -->

</body>

</html>
