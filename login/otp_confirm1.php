<?php
    session_start();
    if(isset($_SESSION['otp']))
    {
        $otp=$_SESSION['otp'];
        if(isset($_REQUEST['btn-confirm-otp']))
        {
            $otp1=$_REQUEST['otp'];
            if($otp==$otp1)
            {
                header("Location: change_password1.php");
            }
            else
            {
                echo "<script type=\"text/javascript\">".
                                "alert('Invalid OTP');".
                                    "</script>";
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
    <style>
    .center {
        text-align: left;
    }
    </style>
</head>

<body>

    <!-- form section start -->
    <section class="w3l-workinghny-form ">
        <!-- /form -->
        <div class="workinghny-form-grid">
            <div class="wrapper">
                <div class="logo">
                    <h1><a class="brand-logo" style="pointer-events:none;"> Forgot Password </a></h1>
                    <!-- if logo is image enable this   
                        <a class="brand-logo" href="#index.php">
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

                                    <label>OTP</label>
                                    <input type="number" name="otp" id="otp" placeholder="Enter OTP"
                                        style="font-weight: bold;" required="">
                                </div>
                                <button type="submit" class="btn btn-style mt-3 w3-theme-d2"
                                    name="btn-confirm-otp">Change Password</button>
                                <p class="already">Don't have an account? <a href="signup.php">Register Now</a></p>
                                <p class="already">OR</p>
                                <p class="already">Already have an account? <a href="login.php">Login Here</a></p>
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
<?php
}

?>