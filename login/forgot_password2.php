<?php
    session_start();
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

                                    <label>E-mail</label>
                                    <input type="email" name="email" id="email" placeholder="Enter Registered Email"
                                        required="">
                                </div>
                                <button type="submit" class="btn btn-style mt-3 w3-theme-d2"
                                    name="btn-forgot-password">Submit</button>
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
    if(isset($_REQUEST['btn-forgot-password']))
    {
        $post_email=$_REQUEST['email'];
        include 'connection.php';
        $sql="SELECT * FROM tbl_distributor WHERE email_id='$post_email'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $mail=$row['email_id'];
        $otp=rand(1000,9999);
        if($post_email==$mail)
        {
            $to = "$mail";
            $subject = "Forgot Password";
            $otp=rand(1000,9999);

            $message = "<b><h3>E-Ration Team.</h3></b>";
            $message .= "<h5>Your OTP is $otp.<br>Don't share with anyone.</h5>";
            
            $header = "From:nallaabhi2003@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            
            $retval = mail ($to,$subject,$message,$header);
            
            if( $retval == true ) {
                $_SESSION['mail']=$post_email;
                $_SESSION['otp']=$otp;
                echo '<script>
                alert("OTP is sent to Registered Email...");
                window.location.href="otp_confirm2.php";
                </script>';
            }else {
                echo '<script>
                alert("Something Went Wrong...");
                window.location.href="forgot_password2.php";
                </script>';
            }
        }
        else 
        {
            echo '<script>
                alert("You are not a user");
                window.location.href="../index.php";
                </script>';
        }
    }
?>