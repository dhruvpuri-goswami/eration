<?php
include "../php/connection.php";
include '../php/config.php' ?>



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
    <link rel="stylesheet" href="../assets/css/style.css">
    <!--//Style-CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <h2><a class="brand-logo" style="pointer-events:none;"> Register Here</a></h2>
                </div>
                <div class="workinghny-block-grid">
                    <div class="workinghny-left-img align-end">
                        <img src="register.jpg" class="img-responsive" alt="img" />
                    </div>
                    <div class="form-right-inf">
                        <div class="login-form-content">
                            <div class="loginuser admin w3-margin-right w3-margin-left w3-margin-top">
                                <label>Rationcard Number</label>
                                <div class="inputdiv" style="display:flex;align-content:center">
                                    <input type="number" minlength="15" class="w3-input w3-margin-top w3-margin-bottom"
                                        name="rationNumber" id="rationNumber" placeholder="Enter Rationcard" required>

                                    <i class="fa-regular fa-eye-slash"></i>
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                                <!-- 
                                    <input type="password" class="w3-input w3-margin-top" name="adminpass"
                                    <label>Enter Password</label>
                                     placeholder="Enter Password" required>

                                        <label>Enter Confirm Password</label>
                                    <input type="password" class="w3-input w3-margin-top" name="adminpass"
                                        placeholder="Enter Password" required> -->


                                <button class="btn btn-style mt-10" style="background-color: #007dfe" onclick="registerUser()">Verify
                                    Account</button>
                            </div>
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
        /*code for verifying OTP */
        var verifyOTP = async () => {
            const userOTP = document.getElementById('userOTP').value;
            if (userOTP < 10000 && userOTP > 999) {
                await fetch('./registration.php', {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "userOTP": userOTP,
                    })
                }).then((response) => {
                    return response.json();
                }).then((result) => {
                    if (result.status == 200) {
                        const changeDiv = document.querySelector('.loginuser');
                        changeDiv.innerHTML = `<label>Password</label>
                                <input type="password" max-width="16" class="w3-input w3-margin-top w3-margin-bottom" name="password" id="password" placeholder="Enter Password" required>
                                <input type="password" max-width="16" class="w3-input w3-margin-top w3-margin-bottom" name="confirmPassword" id="confirmPassword" placeholder="Reenter Password" required>
                                <button onClick="register()" class="btn btn-style mt-10 w3-theme-b3">Register</button>`;
                    } else {
                        alert(result.msg);
                    }
                });
            } else {
                alert("Please enter 4 digit OTP!");
            }
        }

        /*for storing data into databdase */
        var register = async () => {
            if (password == "") {
                alert("Please Enter password!");
            } else {
                const password = document.getElementById('password').value;
                const cnfPassword = document.getElementById('confirmPassword').value;
                if (password === cnfPassword) {
                    if (password.length < 8) {
                        alert("Please Enter 8 character long password");
                    } else {
                        const password = document.getElementById('password').value;
                        console.log(password);
                        await fetch('./registration.php', {
                            method: 'POST',
                            header: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                "password": password,
                            })
                        }).then((response) => {
                            return response.json();
                        }).then((result) => {
                            if (result.status == 200) {
                                window.location.href = './login.php';
                            } else {
                                alert(result.msg);
                            }
                        });
                    }
                } else {
                    alert('Please,same password on both the feilds!');
                }
            }
        }

        const registerUser = async () => {
            const rationNumber = document.getElementById('rationNumber').value;

            if (rationNumber !== undefined) {
                await fetch('./registration.php', {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "ration_number": rationNumber,
                        "isVarification": 0
                    })
                }).then((response) => {
                    return response.json();
                }).then((result) => {
                    if (result.status == 200) {
                        const changeDiv = document.querySelector('.loginuser');
                        changeDiv.innerHTML = `<label>OTP</label>
                                <input type="number" minlength="4" max-width="4" class="w3-input w3-margin-top w3-margin-bottom" name="userOTP" id="userOTP" placeholder="Enter OTP" required>
                                <button class="btn btn-style mt-10 w3-theme-b3" onclick="verifyOTP()">Verify</button>`;
                    } else {
                        alert(result.msg);
                    }
                })
            }
        }
    </script>
</body>

</html>