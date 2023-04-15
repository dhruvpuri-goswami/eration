<?php
  session_start();
  if(isset($_SESSION['rationcard_no']))
  {
  $rcard_no=$_SESSION['rationcard_no'];
  $c_rc=$_REQUEST['c_rc'];
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

  $sql1="SELECT * FROM tbl_user WHERE rationcard_no='$c_rc'";
  $result2=mysqli_query($conn,$sql1);
  $customer=mysqli_fetch_assoc($result2);
  $c_name=$customer['fname']." ". $customer['mname']." ". $customer['lname'];
  $c_address=$customer['address'];
  $c_ph=$customer['contact_no'];
  $c_mail=$customer['email_id'];
  $u_id=$customer['u_id'];

  $sql2="SELECT * FROM tbl_book WHERE rationcard_no='$c_rc' ORDER BY date DESC LIMIT 1";
  $result2=mysqli_query($conn,$sql2);
  $details=mysqli_fetch_assoc($result2);
  $count=mysqli_num_rows($result2);

    $total_amount=0
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
                <span class="dashboard">Customers</span>
            </div>
            <div class="profile-details">
                <img src="<?php echo "../uploads_images/".$d_image; ?>" alt="Error">
                <span class="distributor_name"><?php echo $d_fname." ". $d_lname; ?></span>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <div class="center">
                            Customer Details
                        </div>
                        <hr>
                        <div class="details">
                            Name: <?php echo $c_name; ?><br>
                            Phone No: <?php echo $c_ph; ?><br>
                            Email-Id: <?php echo $c_mail; ?><br>
                            Address: <?php echo $c_address; ?>
                        </div>
                        <br><br>
                        <div class="center">
                            Distributor Details
                        </div>
                        <hr>
                        <div class="details">   
                            Name: <?php echo $d_fname." ". $d_mname ." ". $d_lname; ?><br>
                            Phone No: <?php echo $d_ph; ?><br>
                            PDS No: <?php echo $d_pds; ?><br>
                            Shop Address: <?php echo $d_address; ?>
                        </div><br>
                        <button type="button" class="w3-padding w3-round-large w3-margin-top w3-dark-blue w3-center" style="display:flex;justify-content:center;">
                                        <a href="./QrCode/authentication.php?rc=<?php echo $c_rc; ?>"
                                            style="text-decoration:none">Verify Booking Details</a>
                                    </button>
                        </div>
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
    if(isset($_REQUEST['btnsubmit']))
    {
        $date=$_REQUEST['date'];
        $b_id=$_REQUEST['b_id'];
        $sql3="UPDATE tbl_book SET given_date='$date', ration_grant='1' WHERE booking_id='$b_id'";
        $sql4="INSERT INTO tbl_dist_receipt (booking_id, date, rationcard_no, d_pds, amount)
        VALUES ('$b_id', '$date', '$c_rc', '$d_pds', '$total_amount')";
        if($state=="1")
        {
            if(mysqli_query($conn,$sql3) and mysqli_query($conn,$sql4))
            {
                ?>
<script>
window.location.href = "dist_receipt.php?c_rc=<?php echo $c_rc; ?>&u_id=<?php echo $u_id; ?>";
</script>
<?php
            }
            else
            {
                echo '<script>alert("Something Went Wrong")</script>';
            }
        }
        else
        {
            echo '<script>alert("Payment has been not done yet")</script>';
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