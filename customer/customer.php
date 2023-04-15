<?php
session_start();
if (isset($_SESSION['rationcard_no'])) {
    date_default_timezone_set("Asia/Kolkata");    
    $date=date("Y-m-d");
    include 'config.php';
    $rcard_no = $_SESSION['rationcard_no'];
    include 'connection.php';
    $sql = "SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    $name = $rows['fname'] . " " . $rows['mname'] . " " . $rows['lname'];
    $mail=$rows['email_id'];
    $image=$rows['image'];
    $sql2 = "SELECT * FROM `tbl_stock`";
    $result2 = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    $sql3="SELECT given_date FROM tbl_book WHERE rationcard_no='$rcard_no' ORDER BY given_date DESC";
    $result3=mysqli_query($conn,$sql3);
    $fetch=mysqli_fetch_assoc($result3);
    $cnt=mysqli_num_rows($result3);
    if($cnt>0)
    {
        $r_date=$fetch['given_date'];
    }
    $Date=$r_date;
    $t_date = date('Y-m-d', strtotime($Date. ' + 30 days'));
    $_SESSION['t_date']=$t_date;
    if(isset($r_date))
    {
        $sql4="SELECT * FROM tbl_book WHERE rationcard_no='$rcard_no' ORDER BY given_date DESC";
        $result4=mysqli_query($conn,$sql4);
        $ser_mail=mysqli_fetch_assoc($result4);
        $check=$ser_mail['status_for_mail'];
        $b_id=$ser_mail['booking_id'];
        if($check==0)
        {
            if($date==$t_date)
            {
                $to = $mail;
                $subject = "Ration Assigned";
                $message = "<b><h1>E-Ration Team.</h1></b>";
                $message .= "<h4>Your ration is now available.</h4>";
                $message .= "<h4>Book your raion now,<a href='http://localhost/project-submission-it-batch-2019-E-RATION/eration/customer/customer.php'>Click Here</a></h4>";
                    
                $header = "From:nallaabhi2003@gmail.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                    
                $retval = mail ($to,$subject,$message,$header);
                if($retval)
                {
                    $sql5="UPDATE tbl_book SET status_for_mail='1' WHERE booking_id='$b_id'";
                    $update=mysqli_query($conn,$sql5);
                }
                else
                {
                    echo '<script>alert("No sent mail")</script>';
                }
            }
        }
    }
    else
    {
        $_SESSION['t_date']=$date;
    }
    
    if (isset($_POST['add'])) {

        if (isset($_SESSION['cart'])) {

            $item_array_id = array_column($_SESSION['cart'], "product_id");

            if (in_array($_POST['product_id'], $item_array_id)) {
                echo "<script>alert('Product is already added in the cart...!')</script>";
                echo "<script>window.location='customer.php'</script>";
            } else {
                $count = count($_SESSION['cart']);
                $item_array = array('product_id' => $_POST['product_id']);
                $_SESSION['cart'][$count] = $item_array;
            }
        } else {
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][0] = $item_array;
        }
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css?v=<?= $v ?>">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <script>window.addEventListener('load',(event)=>{
            if(localStorage.getItem('theme') =='dark'){
                body.classList.add('dark');
                modeText.innerText = "Light mode";
            }else{
                body.classList.remove('dark');
                modeText.innerText = "Dark mode";
            }
        })</script>

    <title>Customer Dashboard | E-Ration</title>
    <style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        background-color: black;
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

    .card button {
        border: none;
        outline: 0;
        padding: 12px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .card button:hover {
        opacity: 0.7;
    }
    </style>
</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="l2.png" width="100px" height="40px" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name"><img src="l1.png" alt="" width="120px" height="40px"></span>
                    <!-- span class="profession"><img src="quote.png" alt="" width="80px" height="20px"></span -->
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="mycart.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Book Ration</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="history.php">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Transactions</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="myrationcard.php">
                            <i class='bx bx-card icon'></i>
                            <span class="text nav-text">My Ration Card</span>
                        </a>
                    </li>

                    <li>
                        <a href="complain.php">
                            <i class="bx bx-pointer icon"></i>
                            <span class="text nav-text">Add Complaint</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="edit_profile.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">My Profile</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="update_cart.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <section class="home">
        <div class="top">
            <div class="head">
                <i class='bx bx-home sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>

            <div class="profile-details w3-hide-small">
                <div class="w3-round-large w3-border" style="padding:2px">
                    <img src="l2.png" alt="">
                    <span class="admin_name"><?php echo $name;
                    
                            ?></span>
                    <div class="w3-dropdown-hover w3-hover-none">
                        <button class="w3-button"><i class="fa fa-caret-down"></i></button>
                        <div class="w3-dropdown-content w3-bar-block w3-border">
                            <a href="edit_profile.php" class="w3-bar-item w3-button">Edit Profile</a>
                            <a href="logout.php" class="w3-bar-item w3-button">Log Out</a>
                        </div>
                    </div>
                </div>
                <button onclick="window.location.href='mycart.php'" type="submit"
                    class="w3-card w3-padding w3-round-large w3-dark-blue w3-margin-left">

                    <div class="cart">
                        <label style="font-size:16px;margin-right:2px;margin-left:5px;color:#fff;">Cart :
                            <?php
                                if (isset($_SESSION['cart'])) {
                                    $count = count($_SESSION['cart']);
                                    if($count>1)
                                    {
                                        echo "<span><b>$count Items</b></span>";
                                        $_SESSION['count'] = $count;
                                    }
                                    else
                                    {
                                        echo "<span><b>$count Item</b></span>";
                                        $_SESSION['count'] = $count;
                                    }
                                } else {
                                    $_SESSION['count'] = 0;
                                    echo "<span>0 Item</span>";
                                }
                                ?>
                        </label>
                </button>
            </div>
        </div>
        </div>

        </div>
        <div class="welcome-banner w3-container w3-margin-left">
            <ul class="w3-ul w3-dark-blue w3-card-4 w3-round-large">
                <li class="w3-bar">
                    <img src="<?php echo "../uploads_images/" . $image; ?>" alt="Error"
                        class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
                    <div class="w3-bar-item">
                        <span class="w3-large">Hello
                            <?php echo $name; ?>,</span><br>
                        <span>Welcome to the E-Ration...
                        </span>
                    </div>
                </li>
        </div>
        <?php
        if(isset($r_date))
        {
            if($date==$t_date)
            {
            ?>
        <div class="w3-container w3-margin-top w3-margin-right w3-round-large w3-padding" style="margin-left:2.2rem">
            <h2><b>Book Your Ration</b></h2>
            <div class="scrollmenu">
                <tr>
                    <th>
                        <?php
                                $n = 1;
                                foreach ($rows as $row) {
                                ?>
                        <form method="post" action="">
                            <div class="card w3-margin-top w3-round-large">
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
                                <p><button class="w3-dark-blue w3-margin-top w3-round" type="submit" name="add">Add to
                                        Cart</button></p>
                                <input type="hidden" name="product_id" value="<?php echo $row['stock_id']; ?>">
                            </div>
                        </form>
                        <?php
                                    $n = $n + 1;
                                }
                                ?>
            </div>
        </div>
        <?php
            }
            else
            {
                echo "<h3 style='margin-left:100px;'>No Ration is available now.</h3>";
            }
        }
        else
        {?>
        <div class="w3-container w3-margin-top w3-margin-right w3-round-large w3-padding" style="margin-left:2.2rem">
            <h2><b>Book Your Ration</b></h2>
            <div class="scrollmenu">
                <tr>
                    <th>
                        <?php
                                $n = 1;
                                foreach ($rows as $row) {
                                ?>
                        <form method="post" action="">
                            <div class="card w3-margin-top w3-round-large">
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
                                <p><button class="w3-dark-blue w3-margin-top w3-round" type="submit" name="add">Add to
                                        Cart</button></p>
                                <input type="hidden" name="product_id" value="<?php echo $row['stock_id']; ?>">
                            </div>
                        </form>
                        <?php
                                    $n = $n + 1;
                                }
                                ?>
            </div>
        </div>
        <?php
        }
        ?>
    </section>

    <script>
    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        searchBtn = body.querySelector(".search-box"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    })

    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    })

    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Light mode";
            localStorage.setItem('theme','dark');
        } else {
            modeText.innerText = "Dark mode";
            localStorage.setItem('theme','light');
        }
    });
    </script>

</body>

</html>
<?php
} else {
    header("location: ../login/login.php");
}
?>