<?php
session_start();
if(isset($_SESSION['user']))
{
	?>
<?php
      include '../php/config.php';
      include ('../php/connection.php');
      $sql2="SELECT tbl_apply_stock.ap_id ,tbl_apply_stock.date ,tbl_stock.stock_id ,tbl_stock.stock_name, tbl_distributor.fname,
      tbl_distributor.pds_no FROM tbl_stock, tbl_distributor, tbl_apply_stock 
      WHERE tbl_apply_stock.pds_no=tbl_distributor.pds_no AND tbl_apply_stock.stock_id=tbl_stock.stock_id 
      ORDER BY tbl_apply_stock.ap_id";
      $result3=mysqli_query($conn,$sql2);
      $rows=mysqli_fetch_all($result3,MYSQLI_ASSOC);
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin | E-Ration </title>
    <link rel="stylesheet" href="style.css?v=<?=$v?>">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
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
                <a href="#" class="active">
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
                <span class="dashboard">View Applied Stock</span>
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
                        <form action="" method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Applied Id</th>
                                        <th>Date</th>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Distributor Name </th>
                                        <th>PDS No.</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                      foreach($rows as $row)
                      {
                    ?>
                                    <tr>
                                        <td data-label="Applied Id"><?php echo $row['ap_id']; ?></td>
                                        <td data-label="Date"><?php echo $row['date']; ?></td>
                                        <td data-label="Item ID"><?php echo $row['stock_id']; ?></td>
                                        <td data-label="Item Name"><?php echo $row['stock_name']; ?></td>
                                        <td data-label="Name"><?php echo $row['fname']; ?></td>
                                        <td data-label="PDS No."><?php echo $row['pds_no']; ?></td>
                                        <td data-label=""><a
                                                href="print_applied_stock.php?sr_id=<?php echo $row['ap_id']; ?>"
                                                class="w3-round-large w3-dark-blue w3-button" name="btnprint">Print</a>
                                        </td>
                                    </tr>
                                    <?php
                      }
                    ?>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
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
}
else
{
	header("location: ../login/login.php");
}
?>