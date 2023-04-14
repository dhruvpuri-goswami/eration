<?php
//This script will handle login
session_start();
if (isset($_SESSION['rationcard_no'])) {
    session_destroy();
}
/* check if the user is already logged in
    if(isset($_SESSION['user']))
    {
       header("location: distributor.php");
       exit;
    }*/
include "connection.php";
if (isset($_POST['btn-login'])) {
    $post_rc_no = mysqli_real_escape_string($conn, $_POST['rc_no']);
    $post_password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $sql = "SELECT u_id FROM tbl_user WHERE rationcard_no='$post_rc_no' and password='$post_password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    $sql1 = "SELECT d_id FROM tbl_distributor WHERE rationcard_no='$post_rc_no' and password='$post_password'";
    $result1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $count1 = mysqli_num_rows($result1);
    //checking for admin
    if ($post_rc_no == $default_rc_no && $post_password == $default_password) {
        header("location: ../admin/index.php");
    }
    //checking customer is in database or not
    else if ($count > 0) {
        $_SESSION['rationcard_no'] = $post_rc_no;
        $_SESSION['flag']="1";
        sleep(2);
        header("location: ../customer/customer.php");
    }
    //checking for distributor is in DB or not
    else if ($count1 > 0) {
        $_SESSION['rationcard_no'] = $post_rc_no;
        sleep(2);
        header("location: ../distributor/dist_dash.php");
    }
    //if all of above are not true then it will execute this
    else {
        sleep(2);
        echo '<script>alert("Please Register Yourself")</script>';
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
                    <h1><a class="brand-logo" style="pointer-events:none;"> Log In Here</a></h1>
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
                        <form action="" class="login-form-content">
                            <label>Select User Type</label>
                            <select class="w3-input w3-margin-top w3-margin-right w3-margin-left" required>
                                <option>Select User</option>
                                <option value="admin">Admin</option>
                                <option value="cust">Customer</option>
                                <option value="dist">Distributor</option>
                            </select>
                            <div class="loginuser admin w3-margin-right w3-margin-left w3-margin-top">
                                <form action="" method="post">
                                    <label>Enter Username</label>
                                    <input type="text" class="w3-input w3-margin-top w3-margin-bottom"
                                        name="adminusername" placeholder="Enter Username" required>

                                    <label>Enter Password</label>
                                    <input type="password" class="w3-input w3-margin-top" name="adminpass"
                                        placeholder="Enter Password" required>

                                    <button type="submit" class="btn btn-style mt-3 w3-theme-d3" name="btn-admin">Sign
                                        In </button>

                                </form>
                                <?php
                                if (isset($_REQUEST['btn-admin'])) {
                                    include 'connection.php';
                                    $post_rc_no = $_REQUEST['adminusername'];
                                    $post_password = $_REQUEST['adminpass'];
                                    if ($post_rc_no == $default_rc_no && $post_password == $default_password) {
                                        $_SESSION['user'] = $post_rc_no;
                                        sleep(2);
                                        header("location: ../admin/admin_dash.php");
                                    } else {
                                        sleep(2);
                                        echo '<script>alert("Please Enter Correct Crendentials of Admin")</script>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="loginuser dist w3-margin-right w3-margin-left">
                                <form action="" method="post">
                                    <label>Enter PDS Number</label>
                                    <input type="number" class="w3-input w3-margin-top w3-margin-bottom" name="distpds"
                                        placeholder="Enter PDS No" required>

                                    <label>Enter Password</label>
                                    <input type="password" class="w3-input w3-margin-top" name="distpass" required
                                        placeholder="Enter Password">

                                    <a href="forgot_password2.php"
                                        style="float: right;text-decoration: none;color: blue; font-weight: bold;"
                                        class="w3-margin-bottom">Forgot the password?</a>
                                    <button type="submit" class="btn btn-style mt-3 w3-theme-d3" name="btn-dist">Sign In
                                    </button>
                                </form>
                            </div>
                            <?php
                            if (isset($_REQUEST['btn-dist'])) {
                                include 'connection.php';
                                $post_pds_no = $_REQUEST['distpds'];
                                $post_password = md5($_REQUEST['distpass']);
                                $sql = "SELECT * FROM tbl_distributor WHERE pds_no='$post_pds_no' and password='$post_password'";
                                $result = mysqli_query($conn, $sql);
                                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                $count = mysqli_num_rows($result);
                                foreach ($rows as $row) {
                                    $post_rc_no = $row['rationcard_no'];
                                }
                                if ($count == 1) {
                                    $_SESSION['rationcard_no'] = $post_rc_no;
                                    sleep(2);
                                    echo "<script>
                                    window.location.href='../distributor/dist_dash.php';
                                    </script>";
                                } else {
                                    sleep(2);
                                    echo '<script>
                                    alert("Distributor Details are not correct");
                                    </script>';
                                }
                            }
                            ?>
                            <div class="loginuser cust w3-margin-left w3-margin-right">
                                <form action="" method="post">
                                    <label>Enter Rationcard Number</label>
                                    <input type="number" class="w3-input w3-margin-top w3-margin-bottom"
                                        name="custusername" placeholder="Enter Ration Card No" required maxlength="15">

                                    <label>Enter Password</label>
                                    <input type="password" class="w3-input w3-margin-top" name="custpassword"
                                        placeholder="Enter Password" required>

                                    <a href="forgot_password1.php"
                                        style="float: right;text-decoration: none;color: blue; font-weight: bold;"
                                        class="w3-margin-bottom">Forgot the password?</a>
                                    <button type="submit" class="btn btn-style mt-3 w3-theme-d3" name="btn-cust">Sign In
                                    </button>
                                    <p class="already">Don't have an account? <a href="signup.php">Register Now</a></p>
                            </div>
                        </form>
                    </div>
                    <?php
                            if (isset($_REQUEST['btn-cust'])) {
                                include 'connection.php';
                                $post_rc_no = $_REQUEST['custusername'];
                                $post_password = md5($_REQUEST['custpassword']);
                                $sql1 = "SELECT u_id FROM tbl_user WHERE rationcard_no='$post_rc_no' and password='$post_password'";
                                $result1 = mysqli_query($conn, $sql1);
                                $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                                $count = mysqli_num_rows($result1);
                                if ($count > 0) {
                                    $_SESSION['rationcard_no'] = $post_rc_no;
                                    sleep(2);
                                    $script = "<script>window.location = '../customer/customer.php';</script>";
                                    echo $script;
                                } else {
                                    sleep(2);
                                    echo '<script>
                                alert("Customer details are not correct!!!Please Register Yourself");
                                </script>';
                                }
                            }
                            ?>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- //form -->
    </section>
    <!-- //form section start -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".loginuser").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".loginuser").hide();
                }
            });
        }).change();
    });
    </script>
</body>

</html>