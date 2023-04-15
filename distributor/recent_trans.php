<?php
session_start();
include '../php/config.php';
if (isset($_SESSION['rationcard_no'])) {
    $rcard_no = $_SESSION['rationcard_no'];
    include '../php/connection.php';
    $sql = "SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
    $result = mysqli_query($conn, $sql);
    $distributors = mysqli_fetch_assoc($result);
    $pds = $distributors['pds_no'];
    $d_pincode = $distributors['pincode'];
    $d_fname = $distributors['fname'];
    $d_lname = $distributors['lname'];
    $d_image = $distributors['image'];
    $d_pds = $distributors['pds_no'];

    $sql1 = "SELECT * FROM tbl_dist_receipt WHERE d_pds='$pds'";
    $result1 = mysqli_query($conn, $sql1);
    $dist_rec = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result1);
    $n = 1;
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
    <style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-right: 5px;
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
        margin-left: 45%;
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
                <a href="customer.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Customers</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
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
                <span class="dashboard">Recent Transactions</span>
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
                        <table id="customers" class="w3-table-all">
                            <thead>
                                <tr>
                                    <th>SR No</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Ration Card No</th>
                                    <th>Amount</th>
                                </tr>
                                <?php
                                    if ($count > 0) {
                                        foreach ($dist_rec as $rec) {
                                            $c_name = $rec['rationcard_no'];
                                            $sql2 = "SELECT * FROM tbl_user WHERE rationcard_no='$c_name'";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $rows = mysqli_fetch_assoc($result2);
                                            $name = $rows['fname'] . " " . $rows['mname'] . " " . $rows['lname'];
                                    ?>
                                <tr>
                                    <td data-label="SR No"><?php echo $n; ?></td>
                                    <td data-label="Date"><?php echo $rec['date']; ?></td>
                                    <td data-label="Name"><?php echo $name; ?></td>
                                    <td data-label="Ration Card No"><?php echo $rec['rationcard_no']; ?></td>
                                    <td data-label="Date"><?php echo $rec['amount']; ?></td>
                                </tr>
                                <?php
                                            $n = $n + 1;
                                        }
                                    }
                                    ?>
                        </table>
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