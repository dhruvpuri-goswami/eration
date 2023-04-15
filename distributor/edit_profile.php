<?php
session_start();
include '../php/config.php';
if (isset($_SESSION['rationcard_no'])) {
  $rcard_no = $_SESSION['rationcard_no'];
  include '../php/connection.php';
  $sql = "SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
  $result = mysqli_query($conn, $sql);
  $distributors = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($distributors as $distributor) {
    $d_pincode = $distributor['pincode'];
    $d_fname = $distributor['fname'];
    $d_mname = $distributor['mname'];
    $d_lname = $distributor['lname'];
    $d_address = $distributor['address'];
    $d_email_id = $distributor['email_id'];
    $d_rc_no = $distributor['rationcard_no'];
    $d_ac_no = $distributor['aadhar_no'];
    $d_ph_no = $distributor['contact_no'];
    $d_pds_no = $distributor['pds_no'];
    $d_city = $distributor['city'];
    $d_state = $distributor['state'];
    $d_dob = $distributor['dob'];
    $d_image = $distributor['image'];
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Distributor | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                <a href="customer.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Customers</span>
                </a>
            </li>
            <li>
                <a href="recent_trans.php">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Recent Transactions</span>
                </a>
            </li>
            <li>
                <a href="statement.php">
                    <i class='bx bx-message'></i>
                    <span class="links_name">View Statement</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
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
                <span class="dashboard">Edit Profile</span>
            </div>
            <!--div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div-->
            <div class="profile-details">
                <img src="<?php echo "../uploads_images/" . $d_image; ?>" alt="Error">
                <span class="admin_name"><?php echo $d_fname . " " . $d_lname; ?></span>

            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <form action="" method="POST">
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
                                        placeholder="<?php echo $d_email_id; ?>" value="<?php echo $d_email_id; ?>"
                                        required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>DOB</label>
                                    <input class="w3-input w3-border w3-margin-top" name="dob" type="text"
                                        value="<?php echo $d_dob; ?>" disabled>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Phone Number</label>
                                    <input class="w3-input w3-border w3-margin-top" name="phone_no" type="tel"
                                        maxlength="10" placeholder="<?php echo $d_ph_no; ?>"
                                        value="<?php echo $d_ph_no; ?>" required>
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
                                <div class="w3-third w3-margin-top">
                                    <label>PDS No.</label>
                                    <input class="w3-input w3-border w3-margin-top" name="pds_no" type="number"
                                        placeholder="<?php echo $d_pds_no; ?>" disabled>
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
                                        placeholder="<?php echo $d_pincode; ?>" disabled>
                                </div>
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Shop Address</label>
                                    <textarea rows="2" class="w3-margin-top w3-input w3-border"
                                        placeholder="<?php echo $d_address; ?>" name="address" disabled></textarea>
                                </div>
                            </div>
                            <div class="w3-center w3-margin-top">
                                <button class="w3-button w3-round-large"
                                    style="margin: top 100px;margin-bottom: 10px;background-color: #0A2558;color: white;"
                                    name="btn-update-dist">SUBMIT</button>
                            </div>
                        </form>
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
  if (isset($_POST['btn-update-dist'])) {
    $mail = $_POST['email'];
    $ph_no = $_POST['phone_no'];
    include '../php/connection.php';
    $sql1 = "UPDATE tbl_distributor SET email_id='$mail', contact_no='$ph_no' WHERE pds_no='$d_pds_no'";
    if (mysqli_query($conn, $sql1)) {
      echo '<script>alert("Updated Successfully")</script>';
    } else {
      echo '<script>alert("Something Went Wrong")</script>';
    }
  }
  ?>
<?php
} else {
  header("location: ../login/login.php");
}
?>