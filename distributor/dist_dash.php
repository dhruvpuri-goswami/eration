<?php
  session_start();
  include '../php/config.php';
  if(isset($_SESSION['rationcard_no']))
  {
  $rcard_no=$_SESSION['rationcard_no'];
  include '../php/connection.php';
  $sql="SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
  $result=mysqli_query($conn,$sql);
  $distributors=mysqli_fetch_all($result,MYSQLI_ASSOC);
  foreach($distributors as $distributor)
  {
    $d_pincode=$distributor['pincode'];
    $d_fname=$distributor['fname'];
    $d_lname=$distributor['lname'];
    $d_image=$distributor['image'];
  }

  $sql2 = "SELECT * FROM `tbl_stock`";
    $result2 = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        background-color: #0a2558;
        max-width: 250px;
        margin: auto;
        text-align: center;
        font-family: arial;
    }

    div.scrollmenu {
        background-color: #ffffff;
        overflow: auto;
        white-space: nowrap;
    }

    div.scrollmenu form {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }

    div.scrollmenu a:hover {
        background-color: #777;
    }

    .price {
        color: grey;
        font-size: 22px;
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
                <a href="#" class="active">
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
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="profile-details">
                <img src="<?php echo "../uploads_images/".$d_image; ?>" alt="Error">
                <span class="distributor_name"><?php echo $d_fname." ". $d_lname; ?></span>

            </div>
        </nav>

        <div class="home-content">
            <div style="font-size: 24px;font-weight: 500;text-align: center;margin-bottom: 10px;">
                <h1><b>Ration List</b></h1>
            </div>
            <div class="scrollmenu">
                <tr>
                    <th>
                        <?php
                                $n = 1;
                                foreach ($rows as $row) {
                                ?>
                        <form method="post" action="">
                            <div class="card w3-margin-top w3-round-large" style="height: 23rem;">
                                <img class="w3-margin-top" src="<?php echo "../uploads_images/" . $row['img']; ?>"
                                    alt="Wheat" style="width:70%">
                                <h1><?php echo $row['stock_name']; ?></h1>
                                <?php
                                    if($row['stock_name']!="Oil")
                                    {
                                    ?>
                                <p class="price"><?php echo "₹ ".$row['stock_price']; ?>/KG</p>
                                <?php
                                    }
                                    else
                                    {?>
                                <p class="price"><?php echo "₹ ".$row['stock_price']; ?>/Litres</p>
                                <?php
                                    }
                                    ?>
                            </div>
                        </form>
                        <?php
                                    $n = $n + 1;
                                }
                                ?>
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