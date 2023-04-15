<?php
  session_start();
	if(isset($_SESSION['user']))
	{
    include ('../php/connection.php');
    $pds=$_REQUEST['pds'];
    $sql="SELECT * FROM tbl_distributor WHERE pds_no='$pds'";
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_assoc($result);
	?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .heading {
        font-size: x-large;
        text-align: center;
        font-weight: 500;
    }

    button {
        color: #ffffff;
        background-color: #0A2558;
        font-size: 16px;
    }

    .img {
        text-align: left;
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
                <a href="admin_dash.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="add_dist.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Add Distributor</span>
                </a>
            </li>
            <li>
                <a href="add_stock.php">
                    <i class="bx bx-coin-stack"></i>
                    <span class="links_name">Add Stock</span>
                </a>
            </li>
            <li>
                <a href="giveration.php">
                    <i class="bx bx-coin-stack"></i>
                    <span class="links_name">Give Stock</span>
                </a>
            </li>
            <li>
                <a href="applied_stock.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">View Applied Stock</span>
                </a>
            </li>
            <li>
                <a href="stock_details.php">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Stock Details</span>
                </a>
            </li>
            <li>
                <a href="check_complaints.php">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Check Complains</span>
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
                <span class="dashboard">Suspend Distributor</span>
            </div>
            <div class="profile-details">
                <img src="images/profile.jpg" alt="">
                <span class="admin_name">Admin</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <form action="" method="POST">
                            <div class="heading w3-margin w3-xxlarge">
                                Distributor Details
                            </div>
                            <img class="w3-circle w3-right w3-margin"
                                src="<?php echo "../uploads_images/".$rows['image']; ?>" alt="Not Uploaded" width="200"
                                height="200">
                            <label><b>Name : </b><?php echo $rows['fname']." ".$rows['mname']." ".$rows['lname']; ?>
                            </label>
                            <label><b>PDS No : </b><?php echo $rows['pds_no']; ?></label>
                            <label>
                                <b>DOB : </b><?php echo $rows['dob']; ?></label>
                            <label><b>Email : </b><?php echo $rows['email_id']; ?></label>
                            <label><b>Gender : </b><?php echo $rows['gender']; ?></label>
                            <label><b>Address : </b><?php echo $rows['address']; ?></label>
                            <label><b>City : </b><?php echo $rows['city']; ?></label>
                            <label><b>State : </b><?php echo $rows['state']; ?></label>
                            <label><b>Reason : </b></label>
                            <textarea cols="50" rows="3" name="reason" placeholder="Enter Reason"></textarea><br>
                            <button name="del_dist"
                                class="w3-margin w3-button w3-dark-blue w3-round-large w3-center">Suspend
                                Distributor</button>
                        </form>
                        <?php
              if(isset($_REQUEST['del_dist']))
              {
                  $pds=$_REQUEST['pds'];
                  include '../php/connection.php';
                  $fname=$rows['fname'];
                  $mname=$rows['mname'];
                  $lname=$rows['lname'];
                  $ph_no=$rows['contact_no'];
                  $mail=$rows['email_id'];
                  $post_reason=$_REQUEST['reason'];
                  date_default_timezone_set("Asia/Kolkata");
                  $date=date("y-m-d");
                  //deleting from distributor table
                  $sql1="DELETE FROM tbl_distributor WHERE pds_no='$pds'";

                  $sql2="INSERT INTO tbl_suspend_dist (pds_no, fname, mname, lname, contact_no, email_id, reason, suspend_date)
                  VALUES ('$pds', '$fname', '$mname', '$lname', '$ph_no', '$mail', '$post_reason', '$date')";
                  if(mysqli_query($conn,$sql1) and  mysqli_query($conn,$sql2))
                  {
                    echo '<script>
                    alert("Distributor Suspended Successfully");
                    window.location.href="admin_dash.php";
                    </script>';
                  }
                  else
                  {
                      echo '<script>alert("Something Went Wrong..")</script>';
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