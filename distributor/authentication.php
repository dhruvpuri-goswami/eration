<?php
  session_start();
  if(isset($_SESSION['rationcard_no']))
  {
  $rcard_no=$_SESSION['rationcard_no'];
  $user_rc_no=$_REQUEST['rc'];
  include '../php/connection.php';
  $sql="SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
  $result=mysqli_query($conn,$sql);
  $distributors=mysqli_fetch_all($result,MYSQLI_ASSOC);
  foreach($distributors as $distributor)
  {
    $d_pincode=$distributor['pincode'];
    $d_fname=$distributor['fname'];
    $d_mname=$distributor['mname'];
    $d_lname=$distributor['lname'];
    $d_image=$distributor['image'];
    $d_address=$distributor['address'];
    $d_pds=$distributor['pds_no'];
    $d_ph=$distributor['contact_no'];
  }

  
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Distributor | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-right: 5px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0A2558;
        color: white;
    }

    .btn {
        width: 60px;
        text-decoration: none;
        line-height: 35px;
        display: inline-block;
        background-color: #0A2558;
        font-weight: medium;
        color: #ffffff;
        text-align: center;
        vertical-align: none;
        user-select: none;
        border: 1px solid transparent;
        font-size: 14px;
        opacity: 1;
        margin-top: 10px;
        margin-left: 6%;
    }

    .center {
        text-align: center;
        font-size: x-large;
    }

    hr {
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="./images/logo2.png" height="40px" weight="40px" style="margin-left: 10px">
            <img src="./images/logo3.png" height="40px" weight="140px">
        </div>
        <ul class="nav-links">
            <li>
                <a href="dist_dash.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="avail_stock.php">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Check Available Stock</span>
                </a>
            </li>
            <li>
                <a href="apply_stock.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Apply For Stock</span>
                </a>
            </li>
            <li>
                <a href="customer.php" class="active">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Customers</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Recent Transections</span>
                </a>
            </li>
            <li>
                <a href="statement.php">
                    <i class='bx bx-message'></i>
                    <span class="links_name">View Statement</span>
                </a>
            </li>
            <li>
                <a href="edit_profile.php">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Edit Profile</span>
                </a>
            </li>
            <li class="log_out">
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Authenticate User</span>
            </div>
            <div class="profile-details">
                <img src="<?php echo "../uploads_images/".$d_image; ?>" alt="Error">
                <span class="distributor_name"><?php echo $d_fname." ". $d_lname; ?></span>
                <i class='bx bx-chevron-down'></i>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <div>
                            <h3>
                                User Authentication</h3>
                        </div>
                        <hr>
                        <form action="" method="post">
                            <select class="w3-input w3-round-large" name="members" style="width: 20%; height:36px;"
                                required>
                                <option>Select Member</option>
                                <?php
                                $sql1="SELECT * FROM tbl_ration WHERE rationcard_no='$user_rc_no'";
                                $result1=mysqli_query($conn,$sql1);
                                $members=mysqli_fetch_assoc($result1);
                                ?>
                                <option value="<?php echo $members['m_name']; ?>"><?php echo $members['m_name']; ?>
                                </option>
                                <option value="<?php echo $members['p1_name']; ?>">
                                    <?php echo $members['p1_name']; ?>
                                </option>
                                <option value="<?php echo $members['p2_name']; ?>">
                                    <?php echo $members['p2_name']; ?>
                                </option>
                                <option value="<?php echo $members['p3_name']; ?>">
                                    <?php echo $members['p3_name']; ?>
                                </option>
                            </select>
                            <button type="submit" name="proceed"
                                class="w3-padding w3-dark-blue w3-round-large w3-margin-top">Proceed</button>
                        </form>
                        <?php
                        if(isset($_REQUEST['proceed']))
                        {
                            $mem=$_REQUEST['members'];
                        ?>
                        <form action="" method="post">
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Rationcard No.</label>
                                    <input class="w3-input w3-border w3-margin-top" name="rc_no" type="number"
                                        maxlength="15" placeholder="Enter Ration Card No" required>
                                    <input type="hidden" name="mem" value="<?php echo $mem; ?>">
                                </div>
                            </div>

                            <button type="submit" name="auth"
                                class="w3-padding w3-dark-blue w3-round-large w3-margin-top">
                                Authenticate Customer
                            </button>
                        </form>
                        <?php
                        }
                            if(isset($_REQUEST['auth']))
                            {
                                $member=$_REQUEST['mem'];
                                $rc_no=$_REQUEST['rc_no'];
                                $sql3="SELECT * FROM tbl_user WHERE rationcard_no='$rc_no'";
                                $result3=mysqli_query($conn,$sql3);
                                $mail_details=mysqli_fetch_assoc($result3);
                                $mail=$mail_details['email_id'];
                                $count=mysqli_num_rows($result3);
                                if($count>0)
                                {
                                    echo "<script>window.location.href='otp_submit.php?mem=$member&mail=$mail'</script>";  
                                }
                                else
                                {
                                    echo "<script>alert('Entered Ration Card No is not correct')</script>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else
            sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
    </script>
</body>

</html>
<?php
}
else
{
	header("location: ../login/login.php");
}
?>