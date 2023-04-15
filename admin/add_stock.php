<?php
session_start();
if (isset($_SESSION['user'])) {
    include '../php/config.php';
?>
<?php
    if (isset($_POST['add_stock'])) {
        include '../php/connection.php';
        //check if session variable is set or otherwise get data from pds number
        $pds_no = $_REQUEST['pds_no'];
        $sql = "SELECT * FROM tbl_distributor WHERE pds_no='$pds_no'";
        $result = mysqli_query($conn, $sql);
        $distributors = mysqli_fetch_assoc($result);
        $d_pincode = $distributors['pincode'];
        $sql1 = "SELECT tbl_user.* FROM tbl_user, tbl_distributor 
            WHERE tbl_user.pincode='$d_pincode' AND tbl_distributor.pincode='$d_pincode'";
        $result1 = mysqli_query($conn, $sql1);
        $count = mysqli_num_rows($result1);

        $pds = $_REQUEST['pds_no'];
        $name = $_REQUEST['stock_name'];
        $quan = $_REQUEST['quantity'] * $count*4;
        $qry = "UPDATE tbl_pds SET quantity='$quan' where pds_no='$pds' AND stock_name='$name'";
        $rea = mysqli_query($conn, $qry);
        if ($rea) {
            echo "<script>" .
                "alert('Stock Add Successfully');" .
                "</script>";
        } else {
            echo '<script>alert("Something Went Wrong")</script>';
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin | E-Ration </title>
    <link rel="stylesheet" href="style.css?v=<?= $v ?>">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                <a href="#" class="active">
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
                <span class="dashboard">Add Stock</span>
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
                            <button class="w3-button w3-round-large w3-dark-blue" name="btnitem">Search By Item</button>
                            <?php if (isset($_POST['btnitem'])) { ?>
                            <form action="" method="post">
                                <?php
                                        include '../php/connection.php';
                                        $sql3 = "SELECT * FROM tbl_stock";
                                        $result3 = mysqli_query($conn, $sql3);
                                        $stocks = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                                        ?>
                                <br><select class="w3-input w3-margin-top" name="item" style="width: 10%; height:36px;"
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
                                <button class="w3-button w3-round-large w3-dark-blue" type="submit"
                                    name="submit" />Search</button>
                            </form>
                            <?php }
                                ?>
                        </form>
                        <?php
                            if (isset($_POST['submit'])) {
                                include '../php/connection.php';
                                $area = $_REQUEST['item'];
                                $sql = "SELECT * FROM tbl_pds WHERE stock_name ='$area' ORDER BY pds_no";
                                $result2 = mysqli_query($conn, $sql);
                                $sql3 = "SELECT * FROM tbl_stock";
                                $result3 = mysqli_query($conn, $sql3);
                                $stocks = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                            ?>
                        <form action="" method="post">
                            <br><select class="w3-input w3-round-large" name="item" style="width: 10%; height:36px;"
                                required>
                                <option>Select</option>
                                <?php
                                        foreach ($stocks as $stock) {
                                        ?>
                                <option value="<?php echo $stock['stock_name'] ?>"><?php echo $stock['stock_name'] ?>
                                </option>
                                <?php
                                        }
                                        ?>
                            </select><br>
                            <button class="w3-button w3-dark-blue w3-round-large" type="submit"
                                name="submit" />Search</button>
                        </form>
                        <?php
                                if (mysqli_num_rows($result2) != 0) {
                                ?>
                        <table id="customers">
                            <thead>
                                <tr>
                                    <th scope="col">PDS No</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Item Quantity</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                            while ($row = mysqli_fetch_array($result2)) {
                                                //print_r($result);
                                                $a = $row['pds_no'];
                                                $b = $row['stock_name'];
                                            ?>
                                <tr class="w3-center">
                                    <form action="" method="POST">
                                        <td scope="row"><input class="w3-input" type="hidden" value="<?php echo $a; ?>"
                                                name="pds_no">
                                            <?php echo $a; ?>
                                        </td>
                                        <td scope="row"><input type="hidden" value="<?php echo $b; ?>"
                                                name="stock_name">
                                            <?php echo $b; ?>
                                        </td>
                                        <td scope="row"><input class="w3-input" type="text" name="quantity"
                                                placeholder="Enter Quantity Per User in KG" required>
                                        </td>
                                        <td scope="row"><button class="w3-button w3-round-large w3-dark-blue"
                                                type="submit" name="add_stock">Add</button></td>
                                    </form>
                                </tr>
                                <?php
                                            }
                                        }
                                    } ?>
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