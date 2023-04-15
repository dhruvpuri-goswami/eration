<?php
  include "connection.php";
  
    if(isset($_POST['btn-signup']))
        {
        $filename = $_FILES["fileToUpload"]["name"];
        $tempname = $_FILES["fileToUpload"]["tmp_name"];    
        $folder = "../uploads_images/";
            $post_password1=md5(mysqli_real_escape_string($conn,$_POST['password']));
            $post_password2=md5(mysqli_real_escape_string($conn,$_POST['con_password']));
            if($post_password1 == $post_password2)
            {
        $post_fname=mysqli_real_escape_string($conn,$_POST['fname']);
        $post_mname=mysqli_real_escape_string($conn,$_POST['mname']);
        $post_lname=mysqli_real_escape_string($conn,$_POST['lname']);
        $post_add=mysqli_real_escape_string($conn,$_POST['address']);
        $post_ph_no=mysqli_real_escape_string($conn,$_POST['phone_no']);
        $post_gender=mysqli_real_escape_string($conn,$_POST['gender']);
        $post_dob=mysqli_real_escape_string($conn,$_POST['dob']);
        $post_ac_no=mysqli_real_escape_string($conn,$_POST['acard_no']);
        $post_rc_no=$rcard;
        $post_city=mysqli_real_escape_string($conn,$_POST['city']);
        $post_state=mysqli_real_escape_string($conn,$_POST['state']);
        $post_pincode=mysqli_real_escape_string($conn,$_POST['pincode']);
        $post_email=mysqli_real_escape_string($conn,$_POST['email']);
                $sql = "INSERT INTO tbl_user (fname, mname, lname, address, contact_no, gender, dob, aadhar_no, rationcard_no, city, state, pincode, email_id, image, password)
                VALUES ('$post_fname', '$post_mname', '$post_lname', '$post_add', '$post_ph_no', '$post_gender', '$post_dob', '$post_ac_no', '$post_rc_no', '$post_city', '$post_state', '$post_pincode', '$post_email', '$filename', '$post_password1')";
        }
        else {
            echo "<script>alert('Password and Confirm Password Must be Same')</script>";
        }
                if (mysqli_query($conn, $sql)) 
        {
            if (move_uploaded_file($tempname, $folder.$filename)) 
        {
            include 'connection.php';
            $sql1="SELECT * FROM tbl_user WHERE rationcard_no='$post_rc_no'";
            $result1=mysqli_query($conn,$sql1);
            $rows=mysqli_fetch_assoc($result1);
            $u_id=$rows['u_id'];
            $sql2="SELECT * FROM tbl_stock";
            $result2=mysqli_query($conn,$sql2);
            $stocks=mysqli_fetch_all($result2,MYSQLI_ASSOC);
            foreach($stocks as $stock)
            {
            $stock_id=$stock['stock_id'];
            $stock_name=$stock['stock_name'];
            $pre_price=$stock['stock_price'];
            if($stock_name=="Wheat")
            {
                $stock_quantity=5;
            }
            else
            {
                $stock_quantity=1;
            }
            $final_price=$pre_price*$stock_quantity;
            }
            sleep(2);
            echo '<script>
            alert("Registration Successfully");
            window.location.href="../login/login.php";
            </script>';
        }
        else {
            echo "<script>alert('Something Went Wrong')</script>";
        }
            }
        else {
        echo "<script>alert('Something Went Wrong')</script>";
        }
        }
?>
<?php include 'config.php' ?>



<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Register Page</title>
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
                    <h1><a class="brand-logo" style="pointer-events:none;"> Register Here</a></h1>
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
                            <div class="loginuser admin w3-margin-right w3-margin-left w3-margin-top">
                                <form action="" method="post">
                                    <label>Rationcard Number</label>
                                    <input type="text" class="w3-input w3-margin-top w3-margin-bottom"
                                        name="adminusername" placeholder="Enter Username" required>
<!-- 
                                    <label>Enter Password</label>
                                    <input type="password" class="w3-input w3-margin-top" name="adminpass"
                                        placeholder="Enter Password" required>

                                        <label>Enter Confirm Password</label>
                                    <input type="password" class="w3-input w3-margin-top" name="adminpass"
                                        placeholder="Enter Password" required> -->

                                    <button type="submit" class="btn btn-style mt-3 w3-theme-d3" name="btn-admin">Verify Account </button>
                            </div>
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