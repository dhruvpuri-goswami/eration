<?php
    //This script will handle login
    session_start();
    if(isset($_SESSION['user']))
    {
        session_destroy();
    }
    /* check if the user is already logged in
    if(isset($_SESSION['username']))
    {
       header("location: distributor.php");
       exit;
    }*/
    include "connection.php";
    if(isset($_POST['btn-admin-login']))
    {
        $post_username=mysqli_real_escape_string($conn,$_POST['username']);
        $post_password=mysqli_real_escape_string($conn,$_POST['password']);
        if($post_username==$default_rc_no && $post_password==$default_password)
        {
            $_SESSION['user'] = $post_username;
            sleep(2);
            header("location: ../admin/admin_dash.php");
        }
        else
        {
            {
                sleep(2);
                echo '<script>alert("Please Enter Correct Crendentials of Admin")</script>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Login Page</title>
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
</head>

<body>

	 <!-- form section start -->
	 <section class="w3l-workinghny-form " >
        <!-- /form -->
        <div class="workinghny-form-grid">
            <div class="wrapper">
                <div class="logo">
                    <h1><a class="brand-logo" style="pointer-events:none;"> Log In  </a></h1>
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

									<label>Username</label>
									<input type="text" name="username" id="username" placeholder="Enter Username" required="">
								</div>
								<div class="one-frm">
									<label>Password</label>
									<input type="password" name="password" id="password" placeholder="Enter Password" required="">
								</div>
                                <button type="submit" class="btn btn-style mt-3 w3-theme-d2" name="btn-admin-login">Sign In </button>
                                <p class="already">Are You Customer ? <a href="login.php">Login Here</a></p>
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
