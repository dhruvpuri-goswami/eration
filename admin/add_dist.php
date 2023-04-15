<?php
session_start();
if (isset($_SESSION['user'])) {
?>
<?php
    include '../php/config.php';
    //This script will handle login
    //session_start();

    /* check if the user is already logged in
    if(isset($_SESSION['username']))
    {
       header("location: distributor.php");
       exit;
    }*/
    include "../php/connection.php";

    if (isset($_POST['btn-add-dist'])) {
        include "../php/connection.php";
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../uploads_images/";
        $post_password1 = md5(mysqli_real_escape_string($conn, $_POST['password']));
        $post_password2 = md5(mysqli_real_escape_string($conn, $_POST['con_password']));
        if ($post_password1 == $post_password2) {
            $post_fname = $_POST['first_name'];
            $post_mname = $_POST['middle_name'];
            $post_lname = $_POST['last_name'];
            $post_address = $_POST['address'];
            $post_ph_no = $_POST['phone_no'];
            $post_gen = $_POST['gender'];
            $post_dob = $_POST['dob'];
            $post_email = $_POST['email'];
            $post_ac_no = $_POST['acard_no'];
            $post_rc_no = $_POST['rcard_no'];
            $post_city = $_POST['city'];
            $post_state = $_POST['state'];
            $post_pincode = $_POST['pincode'];
            $post_pds_no = $_POST['pds_no'];
            $post_email = $_POST['email'];
            $sql = "INSERT INTO tbl_distributor (fname,mname,lname,address,contact_no,gender,dob,aadhar_no,rationcard_no,pds_no,city,state,pincode,email_id,image,password) 
          VALUES ('$post_fname', '$post_mname', '$post_lname', '$post_address', '$post_ph_no', '$post_gen', '$post_dob', '$post_ac_no', '$post_rc_no', 
          '$post_pds_no', '$post_city', '$post_state', '$post_pincode', '$post_email', '$filename','$post_password1')";

            $sql2 = "SELECT * FROM tbl_stock";
            $result2 = mysqli_query($conn, $sql2);
            $stocks = mysqli_fetch_all($result2, MYSQLI_ASSOC);
            foreach ($stocks as $stock) {
                $stock_name = $stock['stock_name'];
                if ($stock_name == "Wheat") {
                    $stock_quantity = 30;
                } else {
                    $stock_quantity = 10;
                }
                $sql3 = "INSERT INTO tbl_pds (pds_no,stock_name,quantity)
            VALUES ('$post_pds_no', '$stock_name', '$stock_quantity')";
                mysqli_query($conn, $sql3);
            }
            if (mysqli_query($conn, $sql)) {
                if (move_uploaded_file($tempname, $folder . $filename)) {
                    sleep(2);
                    echo '<script>
                      alert("Distributor Added Successfully...");
                      window.location.href="../admin/add_stock.php";
                      </script>';
                } else {
                    sleep(3);
                    echo '<script>alert("Distributor Not Added...")</script>';
                }
            } else
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin | E-Ration </title>
    <link rel="stylesheet" href="style.css?v=<?= $v ?>">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="#" class="active">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Add Distributor</span>
                </a>
            </li>
            <li>
                <a href="add_stock.php">
                    <i class="bx bxs-cart-add"></i>
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
                <a href="stock_details.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Distributors Details</span>
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
                <span class="dashboard">Add Distributor</span>
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
                        <form method="post" enctype="multipart/form-data">
                            <div class="w3-row-padding">
                                <div class="w3-third w3-margin-top">
                                    <label>First Name</label>
                                    <input class="w3-input w3-border w3-margin-top" name="first_name" type="text"
                                        placeholder="Enter First Name" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Middle Name</label>
                                    <input class="w3-input w3-border w3-margin-top" name="middle_name" type="text"
                                        placeholder="Enter Middle Name" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Last Name</label>
                                    <input class="w3-input w3-border w3-margin-top" name="last_name" type="text"
                                        placeholder="Enter Last Name" required>
                                </div>
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Email ID</label>
                                    <input class="w3-input w3-border w3-margin-top" name="email" type="email"
                                        placeholder="Enter Email ID" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>DOB</label>
                                    <input class="w3-input w3-border w3-margin-top" name="dob" type="date" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Phone Number</label>
                                    <input class="w3-input w3-border w3-margin-top" name="phone_no" type="tel"
                                        placeholder="Enter Phone No." maxlength="10" required>
                                </div>
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Aadharcard No.</label>
                                    <input class="w3-input w3-border w3-margin-top" name="acard_no" type="number"
                                        placeholder="Enter Aadharcard No." maxlength="12" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Rationcard No.</label>
                                    <input class="w3-input w3-border w3-margin-top" name="rcard_no" type="number"
                                        placeholder="Enter Rationcard No." maxlength="15" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>PDS No.</label>
                                    <input class="w3-input w3-border w3-margin-top" name="pds_no" type="number"
                                        placeholder="Enter PDS No." required>
                                </div>
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>State</label>
                                    <select class="w3-select w3-margin-top w3-border" name="state">
                                        <option value="" disabled selected>&nbsp;Select your State
                                        </option>
                                        <option value="Gujarat">Gujarat</option>
                                    </select>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>City</label>
                                    <select class="w3-select w3-margin-top w3-border" name="city">
                                        <option value="" disabled selected>&nbsp;Select your City
                                        </option>
                                        <option value="Ahmedabad">Ahmedabad</option>
                                        <option value="Rajkot">Rajkot</option>
                                        <option value="Surat">Surat</option>
                                    </select>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Pincode</label>
                                    <input class="w3-input w3-border w3-margin-top" name="pincode" type="num"
                                        placeholder="Enter Pincode" maxlength="6" required>
                                </div>

                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Gender</label>
                                    <div class="w3-padding-small">
                                        <p>
                                            <input class="w3-radio w3-margin-top w3-padding-small" type="radio"
                                                name="gender" value="male" checked>
                                            <span>Male</span>
                                        </p>
                                        <p>
                                    </div>
                                    <div class="w3-padding-small">
                                        <input class="w3-radio w3-padding-small" type="radio" name="gender"
                                            value="female">
                                        <span>Female</span></p>
                                    </div>
                                    <div class="w3-padding-small">
                                        <p>
                                            <input class="w3-radio w3-padding-small" type="radio" name="gender"
                                                value="other">
                                            <span>Other</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Shop Address</label>
                                    <textarea rows="2" class="w3-margin-top w3-input w3-border"
                                        placeholder="Enter Address" name="address" required></textarea>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Password</label>
                                    <input class="w3-input w3-border w3-margin-top" name="password" type="password"
                                        placeholder="Enter Password" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Confirm Password</label>
                                    <input class="w3-input w3-border w3-margin-top" name="con_password" type="password"
                                        placeholder="Enter Confirm Password" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>File Upload</label>
                                    <input type="file" id="myFile" name="uploadfile">
                                </div>
                            </div>
                    </div>
                    <div class="w3-center w3-margin-top">
                        <button class="w3-button w3-round-large w3-dark-blue" name="btn-add-dist">SUBMIT</button>
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
} else {
    header("location: ../login/login.php");
}
?>