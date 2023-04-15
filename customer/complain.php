<?php 
    session_start();
    if(isset($_SESSION['rationcard_no']))
    {
        include 'config.php';
        $rcard_no=$_SESSION['rationcard_no'];
        include 'connection.php';
        date_default_timezone_set("Asia/Kolkata");    
        $date = date("Y-m-d");

        $sql1="SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
        $result1=mysqli_query($conn,$sql1);
        $users=mysqli_fetch_all($result1,MYSQLI_ASSOC);
        foreach($users as $user)
        {
          $pincode=$user['pincode'];
          $fname=$user['fname'];
          $mname=$user['mname'];
          $lname=$user['lname'];
          $id=$user['u_id'];
          $name=$fname." ". $mname." ". $lname;
        }

        $sql2="SELECT * FROM tbl_distributor WHERE pincode='$pincode'";
        $result2=mysqli_query($conn,$sql2);
        $distributors=mysqli_fetch_assoc($result2);
        $d_pds=$distributors['pds_no'];
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
                        <a href="#" class="active">
                            <i class="bx bx-pointer icon"></i>
                            <span class="text nav-text">Add Complaint</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="edit_profile.php">
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
                <span class="dashboard">Add Complaint</span>
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
                            <input class="w3-input w3-border w3-margin-top" type="text" value="<?php echo $fname; ?>"
                                disabled>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>Middle Name</label>
                            <input class="w3-input w3-border w3-margin-top" type="text" value="<?php echo $mname; ?>"
                                disabled>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>Last Name</label>
                            <input class="w3-input w3-border w3-margin-top" type="text" value="<?php echo $lname; ?>"
                                disabled>
                        </div>
                    </div>
                    <div class="w3-row-padding w3-margin-top">
                        <div class="w3-third w3-margin-top">
                            <label>Date</label>
                            <input class="w3-input w3-border w3-margin-top" type="date" value="<?php echo $date; ?>"
                                disabled>
                        </div>
                        <div class="w3-third w3-margin-top">
                            <label>PDS No</label>
                            <input class="w3-input w3-border w3-margin-top" type="number" value="<?php echo $d_pds; ?>"
                                disabled>
                        </div>
                    </div>
                    <div class="w3-row-padding w3-margin-top">
                        <div class="w3-third w3-margin-top">
                            <label>Description</label>
                            <textarea rows="2" class="w3-margin-top w3-input w3-border" placeholder="Enter Description"
                                name="desc" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="first_name" value="<?php echo $fname; ?>">
                    <input type="hidden" name="middle_name" value="<?php echo $mname; ?>">
                    <input type="hidden" name="last_name" value="<?php echo $lname; ?>">
                    <input type="hidden" name="date" value="<?php echo $date; ?>">
                    <input type="hidden" name="pds" value="<?php echo $d_pds; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="w3-center w3-margin-top">
                        <button class="w3-button w3-round-large"
                            style="margin: top 100px;margin-bottom: 10px;background-color: #0A2558;color: white;"
                            name="btn-com">SUBMIT</button>
                    </div>
                </div>
            </form>
            <?php
            if(isset($_REQUEST['btn-com']))
            {
                $fname=$_REQUEST['first_name'];
                $mname=$_REQUEST['middle_name'];
                $lname=$_REQUEST['last_name'];
                $date=$_REQUEST['date'];
                $id=$_REQUEST['id'];
                $pds=$_REQUEST['pds'];
                $desc=$_REQUEST['desc'];
                $sql3="INSERT INTO tbl_complaint (date, description, u_id, u_fname, u_mname, u_lname, pds_no)
                VALUES ('$date', '$desc', '$id', '$fname', '$mname', '$lname', '$pds')";
                if(mysqli_query($conn,$sql3))
                {
                    echo '<script>alert("Complaint posted successfully!!!");
                    window.location.href="customer.php";
                    </script>';

                }
            }
            ?>
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