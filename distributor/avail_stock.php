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
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Distributor Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css?v=<?= $v ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    #customers {
        margin-top: 20px;
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
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
                <a href="#" class="active">
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
                <span class="dashboard">Check Available Stock</span>
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
                        <form action="" method="POST">
                            <button name="btnitem" class="w3-button w3-dark-blue w3-round-large">Search By Item
                                Name</button>
                            <?php if (isset($_POST['btnitem'])) { ?>
                            <form action="" method="post">
                                <?php
                                        include '../php/connection.php';
                                        $sql3 = "SELECT * FROM tbl_stock";
                                        $result3 = mysqli_query($conn, $sql3);
                                        $stocks = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                                        ?>
                                <br><select name="item" class="w3-input w3-margin-top" style="width:10rem; height:36px;"
                                    required>
                                    <option>Select</option>
                                    <?php
                                            foreach ($stocks as $stock) {
                                            ?>
                                    <option value="<?php echo $stock['stock_name'] ?>">
                                        <?php echo $stock['stock_name'] ?></option>
                                    <?php
                                            }
                                            ?>
                                </select><br>
                                <button type="submit" class="w3-button w3-dark-blue w3-round-large"
                                    name="submit">Search</button>
                            </form>
                            <?php }
                ?>
                        </form>
                        <?php
              if (isset($_REQUEST['submit'])) {
                $item = $_REQUEST['item'];
                $flag = 0;
                include '../php/connection.php';
                $sql = "SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_assoc($result);
                $d_pds = $rows['pds_no'];
                $d_id = $rows['d_id'];
                $d_fname = $rows['fname'];
                $d_mname = $rows['mname'];
                $d_lname = $rows['lname'];
                $d_pincode = $rows['pincode'];

                //fetch pds stock
                $sql3 = "SELECT * FROM tbl_pds WHERE stock_name='$item' AND pds_no='$d_pds'";
                $result3 = mysqli_query($conn, $sql3);
                $p_stock = mysqli_fetch_assoc($result3);
                $d_item_stock=$p_stock['quantity'];

                //fetching stock_id and quantity of per user from tbl_stock
                $sql1 = "SELECT * FROM tbl_stock WHERE stock_name='$item'";
                $result1 = mysqli_query($conn, $sql1);
                $u_rows = mysqli_fetch_assoc($result1);
                $s_id = $u_rows['stock_id'];
                $u_quan=$u_rows['quantity'];

                //fetching customer under pds
                $sql8 = "SELECT * FROM tbl_user WHERE pincode='$d_pincode'";
                $result8 = mysqli_query($conn, $sql8);
                $d_customers = mysqli_fetch_all($result8, MYSQLI_ASSOC);

                //checking if user has taken stock or not
                foreach ($d_customers as $d_customer) {
                  $rc = $d_customer['rationcard_no'];
                  $sql9 = "SELECT * FROM tbl_book where rationcard_no='$rc' AND ration_grant='1' ORDER BY given_date DESC LIMIT 1";
                  $result9 = mysqli_query($conn, $sql9);
                  $cus = mysqli_fetch_assoc($result9);
                  $grant_count = mysqli_num_rows($result9);
                  if ($grant_count == 1) {
                    $flag = $flag + 1;
                  }
                }

                //multiplying flag with 4 and getting total number of people
                $t_quan=($flag*4)* $u_quan;

                //subtract the user stock who has taken the stock
                $total_stock = $d_item_stock - $t_quan;

                //checking if total stock is >0 or<0
                if ($total_stock < 0) {
                  $total_stock = 0;
                }

                //checking whether to insert or update
                $sql4 = "SELECT * FROM tbl_available_stock WHERE stock_name='$item' AND pds_no='$d_pds'";
                $result4 = mysqli_query($conn, $sql4);
                $count = mysqli_num_rows($result4);
                if ($count == 1) {
                  $sql6 = "UPDATE tbl_available_stock SET quantity='$total_stock' 
                    WHERE pds_no='$d_pds' AND stock_name='$item'";
                  $result6 = mysqli_query($conn, $sql6);
                } else {
                  $sql5 = "INSERT INTO tbl_available_stock (pds_no, d_id, d_fname, d_mname, d_lname, stock_id, 
                    stock_name, quantity)
                    VALUES ('$d_pds', '$d_id', '$d_fname', '$d_mname', '$d_lname', '$s_id', '$item', '$total_stock')";
                  $result5 = mysqli_query($conn, $sql5);
                }

                $sql7 = "SELECT * FROM tbl_available_stock WHERE stock_name='$item' AND pds_no='$d_pds'";
                $result7 = mysqli_query($conn, $sql7);
                $a_stocks = mysqli_fetch_array($result7, MYSQLI_ASSOC);
              ?><div class="w3-responsive">
                            <table id="customers" class="w3-table-all">
                                <thead>
                                    <tr>
                                        <th>PDS No</th>
                                        <th>Distributor Name</th>
                                        <th>Item Id</th>
                                        <th>Item Name</th>
                                        <th>Item Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label="PDS No"><?php echo $a_stocks['pds_no']; ?></td>
                                        <td data-label="Distributor Name">
                                            <?php echo $a_stocks['d_fname'] . " " . $a_stocks['d_mname'] . " " . $a_stocks['d_lname']; ?>
                                        </td>
                                        <td data-label="Item Id"><?php echo $a_stocks['stock_id']; ?></td>
                                        <td data-label="Item Name"><?php echo $a_stocks['stock_name']; ?></td>
                                        <?php
                        if ($item != "oil") {
                        ?>
                                        <td data-label="Quantity"><?php echo $a_stocks['quantity'] . " KG"; ?></td>
                                        <?php
                        } else {
                        ?>
                                        <td data-label="Quantity"><?php echo $a_stocks['quantity'] . " Litre"; ?></td>
                                        <?php
                        }
                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
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
} else {
  header("location: ../login/login.php");
}
?>