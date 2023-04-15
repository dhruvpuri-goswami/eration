<?php
session_start();
include 'config.php';
if (isset($_SESSION['rationcard_no'])) {
    
    $rcard_no = $_SESSION['rationcard_no'];
    $t_date = $_SESSION['t_date'];
    include 'connection.php';
    $n = 1;
    $total_amount = 0;
    $sql = "SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    $u_id = $rows['u_id'];
    $name = $rows['fname'] . " " . $rows['mname'] . " " . $rows['lname'];
    $ph_no = $rows['contact_no'];
    $mail = $rows['email_id'];
    $sql1 = "SELECT * FROM tbl_user_stock WHERE u_id='$u_id'
    ORDER BY stock_id";
    $result1 = mysqli_query($conn, $sql1);
    $rows = mysqli_fetch_all($result1, MYSQLI_ASSOC);

    $sql2="SELECT given_date FROM tbl_book WHERE rationcard_no='$rcard_no' ORDER BY given_date DESC";
    $result2=mysqli_query($conn,$sql2);
    $checking=mysqli_fetch_assoc($result2);

    date_default_timezone_set("Asia/Kolkata");
    $date=date("Y-m-d");
?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
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

    <title>Customer | E-Ration</title>
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
                        <a href="customer.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="bookration.php">
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

                    <li class="nav-link">
                        <a href="edit_profile.php">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">My Profile</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
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
                <span class="dashboard">Book Ration</span>
            </div>

            <div class="profile-details w3-hide-small">
                <div class="w3-round-large w3-border" style="padding:2px">
                    <img src="l2.png" alt="">
                    <span class="admin_name"><?php echo $name; ?></span>
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
        <div class="welcome-banner w3-container w3-margin-left">
            <ul class="w3-ul w3-dark-blue w3-card-4 w3-round-large w3-padding">
                <h2 class="w3-text-orange" style="text-shadow:1px 1px 0 #444">
                    <b>Booking Details</b>
                </h2>
            </ul>
            <?php
            if($date==$t_date)
            { 
            ?>
            <div class="book">
                <ul class="w3-ul w3-margin-top w3-card-4 w3-round-large w3-padding">
                    <h4><b>Name : </b><?php echo $name; ?></h4>
                    <h4 class="w3-margin-top"><b>Phone No : </b><?php echo $ph_no; ?></h4>
                    <h4 class="w3-margin-top"><b>Ration Card No : </b><?php echo $rcard_no; ?></h4>
                    <h4 class="w3-margin-top"><b>Ration Card No : </b><?php echo $mail; ?></h4>
                    <h4 class="w3-margin-top"><b>Total Family Members : </b>5</h4>
                    <p class="w3-margin-top w3-large w3-padding-top-24"><input type="checkbox" class="w3-check"
                            id="myCheck" onclick="myFunction()"> I Accept Terms and Condinons</p>
                    <h3></h3>
                    <button
                        class="w3-button w3-hover-orange w3-ripple w3-dark-blue w3-margin-top w3-round-large w3-padding-16"
                        id="send" name="book" onclick="myTable()" disabled>Process to Book Ration</button>
                    <h3 class="w3-padding"></h3>
                </ul>
            </div>
            <div id="third">
                <table class="table w3-margin-top">

                    <thead>
                        <tr>
                            <th>SR No.</th>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Item Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($rows as $row) {
                            ?>
                        <tr>
                            <td data-label="SR No."><?php echo $n; ?></td>
                            <td data-label="Stock ID"><?php echo $row['stock_id']; ?></td>
                            <td data-label="Stock Name"><?php echo $row['stock_name']; ?></td>
                            <?php
                                    if ($row['stock_name'] != "Oil") {
                                    ?>
                            <td data-label="Quantity"><?php echo $row['quantity'] . " KG"; ?></td>
                            <?php
                                    } else {
                                    ?>
                            <td data-label="Quantity"><?php echo $row['quantity'] . " Litre"; ?></td>
                            <?php
                                    }
                                    ?>
                            <td data-label="Price"><?php echo $row['stock_price']; ?></td>
                        </tr>
                        <?php
                                $total_amount = $row['stock_price'] + $total_amount;
                                $n = $n + 1;
                            }
                            ?>
                        <tr>
                            <td colspan="4"><b>Total</b></td>
                            <td><b><?php echo $total_amount;
                                        $_SESSION['total_amount'] = $total_amount;
                                        ?></b></td>
                        </tr>
                    </tbody>
                </table>
                <button onclick="document.getElementById('id01').style.display='block'"
                    class="w3-button w3-hover-orange w3-ripple w3-dark-blue w3-margin-top w3-right w3-round-large w3-padding-16">Confirm
                    Order</button>
                <div id="id01" class="modal">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close"
                        title="Close Modal">×</span>
                    <form class="modal-content" action="/action_page.php">
                        <div class="container">
                            <h1 class="w3-orange w3-round-large w3-padding">Conform Your Bookings</h1>
                            <h3>Select Your Payment Mode</h3>
                            <p>You can pay in 2 ways...</p>
                            <h3><b>Please Choose Your Option .....</b></h3>
                            <div class="clearfix w3-center">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                    class="w3-button w3-hover-orange w3-ripple w3-dark-blue w3-margin-top w3-round-large w3-padding-16 w3-margin-left"><a
                                        href="success1.php" style="text-decoration:none;">Pay Offline</a></button>
                                <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                    class="w3-button w3-hover-orange w3-ripple w3-dark-blue w3-margin-top w3-round-large w3-padding-16 w3-margin-left"><a
                                        href="new_online_payment.php" style="text-decoration:none;">Pay
                                        Online</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            }
            else
            {
                ?>
            <div class="book">
                <ul class="w3-ul w3-margin-top w3-card-4 w3-round-large w3-padding">
                    <h4><b>Name : </b><?php echo $name; ?></h4>
                    <h4 class="w3-margin-top">Ration has been taken on <b><?php echo $checking['given_date']; ?></b>
                    </h4>
                    <h4 class="w3-margin-top"><b>Please wait for email then you can book you Ration</h4>
                    <h4 class="w3-margin-top"><b>Thanks For Visiting</b></h4>
                    <button
                        class="w3-button w3-hover-orange w3-ripple w3-dark-blue w3-margin-top w3-round-large w3-padding-16"
                        name="btnhome"><a href="customer.php"
                            style="text-decoration: none;cursor: default;">Home</a></button>
                    <h3 class="w3-padding"></h3>
                </ul>
            </div>
            <?php
            }
            ?>
        </div>

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
        } else {
            modeText.innerText = "Dark mode";

        }
    });
    </script>
    <script>
    function myFunction() {
        // Get the checkbox
        var checkBox = document.getElementById("myCheck");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true) {
            document.getElementById("send").disabled = false;
        } else {
            document.getElementById("send").disabled = true;
        }
    }
    const targetDiv = document.getElementById("third");
    const btn = document.getElementById("send");
    targetDiv.style.display = "none";
    btn.onclick = function() {
        if (targetDiv.style.display == "none") {
            targetDiv.style.display = "block";
        }
    };
    </script>

    <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>

</body>

</html>
<?php
} else {
    header("location: ../login/login.php");
}
?>