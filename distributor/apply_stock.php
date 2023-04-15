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
    $d_image = $distributor['image'];
    $d_pds = $distributor['pds_no'];
  }
?>
<?php
  if (isset($_POST['btn-edit-dist'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_REQUEST['lname'];
    $stock_name = $_REQUEST['item'];
    $stock_id = $_REQUEST['id'];
    $date = $_REQUEST['date'];
    $t_quan = $_REQUEST['quantity'];
    include '../php/connection.php';
    $sql = "SELECT * FROM tbl_distributor WHERE pds_no='$d_pds'";
    $result = mysqli_query($conn, $sql);
    $distributors = mysqli_fetch_assoc($result);
    $d_pincode = $distributors['pincode'];
    $sql3 = "SELECT tbl_user.* FROM tbl_user, tbl_distributor 
        WHERE tbl_user.pincode='$d_pincode' AND tbl_distributor.pincode='$d_pincode'";
    $result3 = mysqli_query($conn, $sql3);
    $count = mysqli_num_rows($result3);

    $sql4="SELECT * FROM tbl_stock WHERE stock_name='$stock_name'";
    $result4=mysqli_query($conn,$sql4);
    $stock_d=mysqli_fetch_assoc($result4);
    $u_quan=$stock_d['quantity'];

    $quan = $u_quan * $count*4;
    if($t_quan<=$quan && $t_quan>0)
    {
        $sql1 = "SELECT * FROM tbl_stock WHERE stock_name='$stock_name' AND stock_id='$stock_id'";
        $result1 = mysqli_query($conn, $sql1);
        $rows = mysqli_fetch_assoc($result1);
        $stock_price = $rows['stock_price'];

        $sql2 = "INSERT INTO tbl_apply_stock (date, stock_id, stock_name, stock_price,d_fname, d_mname, d_lname, pds_no, quantity)
        VALUES ('$date', '$stock_id', '$stock_name', '$stock_price', '$fname', '$mname', '$lname', '$d_pds', '$quan')";
        if (mysqli_query($conn, $sql2)) {

        echo '<script>alert("Your request has been accepted")</script>';
        } else {
        echo '<script>alert("Something Went Wrong")</script>';
        }
    }
    else
    {
        echo '<script>alert("Entered Quantity is not suitable")</script>';
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Distributor Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css?v=<?= $v ?>">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                <a href="#" class="active">
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
                <span class="dashboard">Apply For Stock</span>
            </div>
            <div class="profile-details">
                <img src="<?php echo "../uploads_images/" . $d_image; ?>" alt="Error">
                <span class="distributor_name"><?php echo $d_fname . " " . $d_lname; ?></span>

            </div>
        </nav>

        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <form action="" method="POST" style="margin-top: 10px;">
                            <h2 class="w3-center" style="margin-bottom: 2rem;">
                                <b>Apply For Stock of PDS No <?php echo $d_pds; ?></b>
                            </h2>
                            <div class="w3-row-padding w3-margin-top w3-margin-bottom">
                                <div class="w3-third w3-margin-top">
                                    <label>First Name</label>
                                    <input type="hidden" name="fname" value="<?php echo $d_fname; ?>">
                                    <input type="text" class="w3-input w3-border w3-margin-top" id="fname"
                                        value="<?php echo $d_fname; ?>" disabled>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Middle Name</label>
                                    <input type="hidden" name="mname" value="<?php echo $d_mname; ?>">
                                    <input type="text" class="w3-input w3-border w3-margin-top" id="mname"
                                        value="<?php echo $d_mname; ?>" disabled>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Last Name</label>
                                    <input type="hidden" name="lname" value="<?php echo $d_lname; ?>">
                                    <input type="text" class="w3-input w3-border w3-margin-top" id="lname"
                                        value="<?php echo $d_lname; ?>" disabled>
                                </div>
                            </div>
                            <div class="w3-row-padding w3-margin-top w3-margin-bottom">
                                <div class="w3-third w3-margin-top">
                                    <label>Item Name</label>
                                    <?php
                    $sql3 = "SELECT * FROM tbl_stock";
                    $result3 = mysqli_query($conn, $sql3);
                    $stocks = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                    ?>
                                    <select id="item" name="item" class="w3-input w3-margin-top">
                                        <option>Select</option>
                                        <?php
                      foreach ($stocks as $stock) {
                      ?>
                                        <option value="<?php echo $stock['stock_name'] ?>">
                                            <?php echo $stock['stock_name'] ?></option>
                                        <?php
                      }
                      ?>
                                    </select>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Item Id</label>
                                    <select id="id" name="id" class="w3-input w3-margin-top">
                                        <option>Select</option>
                                        <?php
                      foreach ($stocks as $stock) {
                      ?>
                                        <option value="<?php echo $stock['stock_id']; ?>">
                                            <?php echo $stock['stock_id']; ?></option>
                                        <?php
                      }
                      ?>
                                    </select>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Date</label>
                                    <input type="date" class="w3-input w3-margin-top" id="date" name="date">
                                </div>
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Quantity</label>
                                    <input type="number" id="quantity" class="w3-input w3-border w3-margin-top"
                                        name="quantity" placeholder="Enter Quantity..">
                                </div>

                            </div>
                    </div>


                    <div class="w3-margin w3-center">
                        <input type="submit" class="w3-button w3-dark-blue w3-round-large " value="Submit"
                            name="btn-edit-dist">
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