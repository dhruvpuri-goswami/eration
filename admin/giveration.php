<?php
session_start();
if(isset($_SESSION['user']))
{
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");
    include '../php/config.php';
    include ('../php/connection.php');
    $sql="SELECT * FROM tbl_distributor";
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    $count=mysqli_num_rows($result);
    $sql4="SELECT DISTINCT date FROM tbl_give_stock ORDER BY date DESC";
    $result4=mysqli_query($conn,$sql4);
    $dates=mysqli_fetch_assoc($result4);
    $cnt=mysqli_num_rows($result4);
    if($cnt>0)
    {
        $last_date=$dates['date'];
    }
    if(isset($last_date))
    {
        $t_date = date('Y-m-d', strtotime($last_date. ' + 30 days'));
    }
    else
    {
        $t_date=$date;
    }
    if(isset($_REQUEST['submit']))
    {
        foreach($rows as $row)
        {
            $pds=$row['pds_no'];
            $pincode=$row['pincode'];
            $sql1 = "SELECT tbl_user.* FROM tbl_user, tbl_distributor 
            WHERE tbl_user.pincode='$pincode' AND tbl_distributor.pincode='$pincode'";
            $result1 = mysqli_query($conn, $sql1);
            $res=mysqli_fetch_all($result1,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result1);
            $sql2="SELECT * FROM tbl_stock";
            $result2=mysqli_query($conn,$sql2);
            $details=mysqli_fetch_all($result2,MYSQLI_ASSOC);
            foreach($details as $detail)
            {
                $name = $detail['stock_name'];
                $quan = $detail['quantity'] * $count*4;
                $sql3="INSERT INTO tbl_give_stock (pds_no, stock_name, quantity, date) VALUES ($pds, '$name', $quan, '$date')";
                $sql5="UPDATE tbl_pds SET quantity='$quan' WHERE pds_no='$pds' AND stock_name='$name'"; 
                mysqli_query($conn,$sql3);
                mysqli_query($conn,$sql5);
            }
            ?>
<script>
alert("Count-" + <?php echo $count; ?>);
</script>
<?php
        }
        echo '<script>
        alert("Stock has been assigned to all PDS");
        window.location.href="giveration.php";
        </script>';
    }
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
                <a href="#" class="active">
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
                <span class="dashboard">Give Stock</span>
            </div>
            <div class="profile-details">
                <img src="images/profile.jpg" alt="">
                <span class="admin_name">Admin</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper w3-round-large">
                    <div class="form_container">
                        <form action="" method="post">
                            <h2><b>Total Distributors : </b><?php echo $count; ?></h2>
                            <?php
                                if($date==$t_date)
                                {
                            ?>
                            <button type="submit" class="w3-round-large w3-button w3-dark-blue w3-padding"
                                style="margin-top:2rem;" name="submit">Assign
                                Ration to
                                All Distributors</button>
                            <?php
                                }
                                else
                                {
                                    ?>
                            <button type="submit" class="w3-round-large w3-button w3-dark-blue w3-padding"
                                style="margin-top:2rem;" name="submit" disabled>Assign
                                Ration to
                                All Distributors</button>
                            <?php
                                echo "<br><br><h3>Stock has been assigned previously on $last_date.<br>Please wait for next month!!</h3>";
                                }
                                ?>
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