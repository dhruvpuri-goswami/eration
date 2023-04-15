<?php
    session_start();
    include "../php/connection.php";
    
    if(isset($_SESSION['user']))
    {
    $sql = "SELECT * FROM tbl_user";
    $result=mysqli_query($conn, $sql);
    $customers = mysqli_num_rows( $result );

    $sql1 = "SELECT * FROM tbl_distributor";
    $result1=mysqli_query($conn, $sql1);
    $distributors = mysqli_num_rows( $result1 );
    $dist_count=mysqli_num_rows($result1);

    $sql2="SELECT fname,mname,lname,pds_no FROM tbl_distributor";
    $result3=mysqli_query($conn,$sql2);
    $rows=mysqli_fetch_all($result3,MYSQLI_ASSOC);

    $sql3="SELECT * FROM tbl_complaint";
    $result3=mysqli_query($conn,$sql3);
    $complaints=mysqli_num_rows($result3);

    $sql4="SELECT * FROM tbl_send_request";
    $result4=mysqli_query($conn,$sql4);
    $requests=mysqli_fetch_all($result4,MYSQLI_ASSOC);
    $count=mysqli_num_rows($result4);

    $sql5 = "SELECT * FROM tbl_apply_stock";
    $result5=mysqli_query($conn, $sql5);
    $stock = mysqli_num_rows( $result5 );


	?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                <a href="#" class="active">
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
                <span class="dashboard">Distributor Details</span>
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
                        <table class="table" cellpadding="5">
                            <thead>
                                <tr>
                                    <th>Distributor Name</th>
                                    <th>PDS Number</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    if($dist_count>0)
                    {
                        foreach($rows as $row)
                        {
                  ?>
                            <tr style="font-size: 16px;margin-top: 3px;margin-bottom:3px;">
                                <td style="padding: 2px;">
                                    <?php
                                      echo $row['fname']." ".$row['mname']." ".$row['lname']."<br>";
                                  ?>
                                </td>
                                <td style="padding: 2px;">
                                    <?php
                                      echo $row['pds_no']."<br>";
                                  ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {?>
                            <tr style="font-size: 16px;margin-top: 3px;margin-bottom:3px;">
                                <td>
                                    No distributor are there
                                </td>
                            </tr>
                            <?php
                    }
                      ?>
                        </tbody>
  
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
}
else
{
	header("location: ../login/login.php");
}
?>