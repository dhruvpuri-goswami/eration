<?php
  session_start();
  if(isset($_SESSION['rationcard_no']))
  {
  $rcard_no=$_SESSION['rationcard_no'];
  $c_rc=$_REQUEST['rc'];
  include '../php/connection.php';
  $sql="SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
  $result=mysqli_query($conn,$sql);
  $distributors=mysqli_fetch_all($result,MYSQLI_ASSOC);
  foreach($distributors as $distributor)
  {
    $d_pincode=$distributor['pincode'];
    $d_fname=$distributor['fname'];
    $d_mname=$distributor['mname'];
    $d_lname=$distributor['lname'];
    $d_image=$distributor['image'];
    $d_address=$distributor['address'];
    $d_pds=$distributor['pds_no'];
    $d_ph=$distributor['contact_no'];
  }

  $sql1="SELECT * FROM tbl_user WHERE rationcard_no='$c_rc'";
  $result2=mysqli_query($conn,$sql1);
  $customer=mysqli_fetch_assoc($result2);
  $c_name=$customer['fname']." ". $customer['mname']." ". $customer['lname'];
  $c_address=$customer['address'];
  $c_ph=$customer['contact_no'];
  $c_mail=$customer['email_id'];
  $u_id=$customer['u_id'];

  $sql2="SELECT * FROM tbl_book WHERE rationcard_no='$c_rc' ORDER BY date DESC LIMIT 1";
  $result2=mysqli_query($conn,$sql2);
  $details=mysqli_fetch_assoc($result2);
  $count=mysqli_num_rows($result2);

    $total_amount=0
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Distributor | E-Ration </title>
    <link rel="stylesheet" href="style.css">
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
        margin-top: 10px;
        margin-bottom: 10px;
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
        margin-top: 10px;
        margin-left: 6%;
    }

    .center {
        text-align: center;
        font-size: x-large;
    }

    hr {
        margin-bottom: 10px;
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
                <a href="customer.php" class="active">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Customers</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Recent Transections</span>
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
                <span class="dashboard">Customers</span>
            </div>
            <div class="profile-details">
                <img src="<?php echo "../uploads_images/".$d_image; ?>" alt="Error">
                <span class="distributor_name"><?php echo $d_fname." ". $d_lname; ?></span>

            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <div class="center">
                            Customer Details
                        </div>
                        <hr>
                        <div class="details">
                            Name: <?php echo $c_name; ?><br>
                            Phone No: <?php echo $c_ph; ?><br>
                            Email-Id: <?php echo $c_mail; ?><br>
                            Address: <?php echo $c_address; ?>
                        </div>
                        <br><br>
                        <div class="center">
                            Distributor Details
                        </div>
                        <hr>
                        <div class="details">
                            Name: <?php echo $d_fname." ". $d_mname ." ". $d_lname; ?><br>
                            Phone No: <?php echo $d_ph; ?><br>
                            PDS No: <?php echo $d_pds; ?><br>
                            Shop Address: <?php echo $d_address; ?>
                        </div>
                        <div class="center">
                            Item Details
                        </div>
                        <hr>
                        <div class="details">
                            <table id="customers">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Item Quantity</th>
                                        <th>Price(in ₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($count>0)
                                    {
                                        $items=$details['items'];
                                        $number = (string) $items;  
                                        /* Reverse the string. */  
                                        $revstr = strrev($number);  
                                        /* writes string into int. */  
                                        $reverse = (int) $revstr; 
                                        while($reverse>0)
                                        {
                                            $dig = $reverse%10;
                                            $sql1="SELECT * FROM tbl_stock WHERE stock_id='$dig'";
                                            $result1=mysqli_query($conn,$sql1);
                                            $rows=mysqli_fetch_assoc($result1);
                                            $reverse = floor($reverse/10);
                            ?>
                                    <tr>
                                        <td data-label="Stock ID"><?php echo $rows['stock_id']; ?></td>
                                        <td data-label="Stock Name"><?php echo $rows['stock_name']; ?></td>
                                        <?php
                                        if($rows['stock_name']!="Oil")
                                        {
                                            $rows['quantity']=$rows['quantity']*4;
                                        ?>
                                        <td data-label="Quantity"><?php echo $rows['quantity']." KG"; ?></td>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <td data-label="Quantity"><?php echo $rows['quantity']." Litre"; ?></td>
                                        <?php
                                        }
                                        ?>
                                        <td data-label="Price">
                                            <?php echo "₹ ". $rows['stock_price']*$rows['quantity']; ?></td>
                                    </tr>
                                    <?php
                                        $total_amount=($rows['stock_price']*$rows['quantity'])+$total_amount;
                                        }
                                    }
                                ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;"><b>Total</b></td>
                                        <td><b><?php echo "₹ ". $total_amount; 
                                ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="center">
                                Booking Details
                            </div>
                            <hr>
                            <div class="details">
                                <?php
                                if($count>0)
                                {
                                    $book_date=$details['date'];
                                    $state=$details['status'];
                                    $book_id=$details['booking_id'];
                                    $grant=$details['ration_grant'];
                                    $grant_date=$details['given_date'];
                                    $amount=$details['amount'];
                                    ?>
                                Booking Id: <?php echo $book_id; ?><br>
                                Booking Date: <?php echo $book_date; ?><br>
                            </div>
                            <div class="center">
                                Payment Details
                            </div>
                            <hr>
                            <div class="details">
                                <form method="post" action="">
                                    <input type="hidden" name="b_id" value="<?php echo $book_id; ?>" />
                                    Date : <input type="date" name="date" style="margin-bottom: 10px;" required /><br>
                                    Amount : <input type="text" placeholder="Enter Amount in ₹" name="amt"
                                        required /><br>
                                    <button class="w3-padding w3-dark-blue w3-round-large w3-margin-top" type="submit"
                                        name="btnsubmit">Submit</button>
                                </form>
                            </div>
                            <?php
                            if(isset($_REQUEST['btnsubmit']))
                            {
                                $b_id=$_REQUEST['b_id'];
                                $d=$_REQUEST['date'];
                                $amt=$_REQUEST['amt'];
                                $com="Complete";
                                $off="Offline";
                                if($d==$book_date)
                                {
                                    if($amt==$amount)
                                    {
                                        $sql3="UPDATE tbl_book SET status='1' WHERE booking_id='$b_id'";
                                        $sql4="UPDATE tbl_receipt SET state='Complete' WHERE date='$d'";
                                        if(mysqli_query($conn,$sql3))
                                        {
                                            if(mysqli_query($conn,$sql4))
                                            {
                                            echo '<script>
                                            alert("Payment Paid Successfully!!");
                                            window.location.href="customer.php";
                                            </script>';
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo "<script>alert('Entered Amount is not Same!!')</script>";
                                    }
                                }
                                else
                                {
                                    echo "<script>alert('Entered Date is not Same!!')</script>";
                                }
                            }
                            ?>
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
}
else
{
	header("location: ../login/login.php");
}
?>