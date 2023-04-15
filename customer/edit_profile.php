<?php 
    session_start();
    if(isset($_SESSION['rationcard_no']))
    {
        include 'config.php';
        $rcard_no=$_SESSION['rationcard_no'];
        include 'connection.php';

        $sql1="SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
        $result1=mysqli_query($conn,$sql1);
        $distributors=mysqli_fetch_all($result1,MYSQLI_ASSOC);
        foreach($distributors as $distributor)
        {
          $d_pincode=$distributor['pincode'];
          $d_fname=$distributor['fname'];
          $d_mname=$distributor['mname'];
          $d_lname=$distributor['lname'];
          $name=$d_fname." ". $d_mname." ". $d_lname;
          $d_address=$distributor['address'];
          $d_email_id=$distributor['email_id'];
          $d_rc_no=$distributor['rationcard_no'];
          $d_ac_no=$distributor['aadhar_no'];
          $d_ph_no=$distributor['contact_no'];
          $d_city=$distributor['city'];
          $d_state=$distributor['state'];
          $d_dob=$distributor['dob'];
          $d_image=$distributor['image']; 
        }
?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css?v=<?=$v?>">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <script>window.addEventListener('load',(event)=>{
            if(localStorage.getItem('theme') =='dark'){
                body.classList.add('dark');
                modeText.innerText = "Light mode";
            }else{
                body.classList.remove('dark');
                modeText.innerText = "Dark mode";
            }
        })</script>
        
    <title>Customer | E-Ration</title>
</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="l2.png" width="100px" height="40px" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name"><img src="l1.png" alt="" width="120px" height="40px"></span>
                    <!-- span class="profession"><img src="quote.png" alt="" width="80px" height="20px"></span -->
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="customer.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="mycart.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Book Ration</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="history.php">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Transactions</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="myrationcard.php">
                            <i class='bx bx-card icon'></i>
                            <span class="text nav-text">My Ration Card</span>
                        </a>
                    </li>
                    <li>
                        <a href="complain.php">
                            <i class="bx bx-pointer icon"></i>
                            <span class="text nav-text">Add Complaint</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">My Profile</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <section class="home">
        <div class="top">
            <div class="head">
                <i class='bx bx-user icon sidebarBtn'></i>
                <span class="dashboard">My Profile</span>
            </div>
            <div class="profile-details w3-hide-small">
                <div class="w3-round-large w3-border" style="padding:2px">
                    <img src="l2.png" alt="">
                    <span class="admin_name"><?php echo $name; ?></span>
                    <div class="w3-dropdown-hover w3-hover-none">
                        <button class="w3-button"><i class="fa fa-caret-down"></i></button>
                        <div class="w3-dropdown-content w3-bar-block w3-border">
                            <a href="edit_profile.php" class="w3-bar-item w3-button">Edit Profile</a>
                            <a href="logout.php" class="w3-bar-item w3-button">Log Out</a>
                        </div>
                    </div>
                </div>
                <button onclick="window.location.href='mycart.php'" type="submit"
                    class="w3-card w3-padding w3-round-large w3-dark-blue w3-margin-left">

                    <div class="cart">
                        <label style="font-size:16px;margin-right:2px;margin-left:5px;color:#fff;">Cart :
                            <?php
                                if (isset($_SESSION['cart'])) {
                                    $count = count($_SESSION['cart']);
                                    if($count>1)
                                    {
                                        echo "<span><b>$count Items</b></span>";
                                        $_SESSION['count'] = $count;
                                    }
                                    else
                                    {
                                        echo "<span><b>$count Item</b></span>";
                                        $_SESSION['count'] = $count;
                                    }
                                } else {
                                    $_SESSION['count'] = 0;
                                    echo "<span>0 Item</span>";
                                }
                                ?>
                        </label>
                </button>
            </div>
        </div><br><br><br>
        <div class="container">
            <form action="" method="POST">
                <div class="whitecolor w3-card w3-margin w3-padding w3-round-large">
                    <div class="w3-row-padding">
                        <div class="w3-third w3-margin-top">
                            <label>First Name</label>
                            <input class="w3-input w3-border w3-margin-top" name="first_name" type="text"
                                placeholder="<?php echo $d_fname; ?>" disabled>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>Middle Name</label>
                            <input class="w3-input w3-border w3-margin-top" name="middle_name" type="text"
                                placeholder="<?php echo $d_mname; ?>" disabled>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>Last Name</label>
                            <input class="w3-input w3-border w3-margin-top" name="last_name" type="text"
                                placeholder="<?php echo $d_lname; ?>" disabled>
                        </div>
                    </div>
                    <div class="w3-row-padding w3-margin-top">
                        <div class="w3-third w3-margin-top">
                            <label>Email ID</label>
                            <input class="w3-input w3-border w3-margin-top" name="email" type="email"
                                placeholder="<?php echo $d_email_id; ?>" value="<?php echo $d_email_id; ?>" required>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>DOB</label>
                            <input class="w3-input w3-border w3-margin-top" name="dob" type="text"
                                value="<?php echo $d_dob; ?>" disabled>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>Phone Number</label>
                            <input class="w3-input w3-border w3-margin-top" name="phone_no" type="number"
                                placeholder="<?php echo $d_ph_no; ?>" value="<?php echo $d_ph_no; ?>" maxlength="10"
                                required>
                        </div>
                    </div>
                    <div class="w3-row-padding w3-margin-top">
                        <div class="w3-third w3-margin-top">
                            <label>Aadharcard No.</label>
                            <input class="w3-input w3-border w3-margin-top" name="acard_no" type="number"
                                placeholder="<?php echo $d_ac_no; ?>" disabled>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>Rationcard No.</label>
                            <input class="w3-input w3-border w3-margin-top" name="rcard_no" type="number"
                                placeholder="<?php echo $d_rc_no; ?>" disabled>
                        </div>
                    </div>
                    <div class="w3-row-padding w3-margin-top">
                        <div class="w3-third w3-margin-top">
                            <label>State</label>
                            <select class="w3-select w3-margin-top w3-border" name="state">
                                <option value="" disabled selected>&nbsp;<?php echo $d_state; ?></option>
                            </select>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>City</label>
                            <select class="w3-select w3-margin-top w3-border" name="city">
                                <option value="" disabled selected>&nbsp;<?php echo $d_city; ?></option>
                            </select>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>Pincode</label>
                            <input class="w3-input w3-border w3-margin-top" name="pincode" type="num"
                                placeholder="<?php echo $d_pincode; ?>" maxlength="6" required>
                        </div>
                    </div>
                    <div class="w3-row-padding w3-margin-top">
                        <div class="w3-third w3-margin-top">
                            <label>Address</label>
                            <textarea rows="2" class="w3-margin-top w3-input w3-border"
                                placeholder="<?php echo $d_address; ?>" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="w3-center w3-margin-top">
                        <button class="w3-button w3-round-large"
                            style="margin: top 100px;margin-bottom: 10px;background-color: #0A2558;color: white;"
                            name="btn-update-dist">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        searchBtn = body.querySelector(".search-box"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");


    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    })

    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    })

    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Light mode";
        } else {
            modeText.innerText = "Dark mode";

        }
    });
    </script>

</body>

</html>
<?php
  if(isset($_POST['btn-update-dist']))
  {
    $mail=$_POST['email'];
    $ph_no=$_POST['phone_no'];
    $pincode=$_POST['pincode'];
    $add=$_POST['address'];
    include 'connection.php';
    $sql1="UPDATE tbl_user SET email_id='$mail', contact_no='$ph_no', pincode='$pincode', address='$add' WHERE rationcard_no='$rcard_no'";
    if(mysqli_query($conn,$sql1))
    {
      echo "<script>alert('Updated Successfully');
      window.location.href='edit_profile.php';
      </script>";
    }
    else{
      echo '<script>alert("Something Went Wrong")</script>';
    }
  }
?>
<?php
}
else
{
	header("location: ../login/login.php");
}
?>