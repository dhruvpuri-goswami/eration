<?php
session_start();
if (isset($_SESSION['rationcard_no'])) {
    include 'config.php';
    $rcard_no = $_SESSION['rationcard_no'];
    include 'connection.php';
    $sql = "SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    $name = $rows['fname'] . " " . $rows['mname'] . " " . $rows['lname'];
    $cnt = $rows['cart'];
    $sql2 = "SELECT * FROM `tbl_stock`";
    $result3 = mysqli_query($conn, $sql2);
    foreach ($customers as $customer) {
        $d_pincode = $customer['pincode'];
        $d_fname = $customer['fname'];
        $d_lname = $distributor['lname'];
        $d_image = $distributor['image'];
    }

    if (isset($_REQUEST['remove'])) {
        print_r($_GET['id']);
        if ($_REQUEST['action'] == 'remove') {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['product_id'] == $_REQUEST['id']) {
                    unset($_SESSION['cart'][$key]);
                    echo "<script>alert('Product has benn Removed..!)</script>";
                    echo "<script>window.location='cart.php'</script>";
                }
            }
        }
    }


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

    <title>Customer Dashboard | E-Ration</title>
    <style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        background-color: black;
        max-width: 300px;
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
                            <span class="text nav-text">Transections</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="myrationcard.php">
                            <i class='bx bx-card icon'></i>
                            <span class="text nav-text">My Ration Card</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Other Services</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">My Profile</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Wallets</span>
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
                    <span class="admin_name"><?php echo $name; ?></span>
                    <div class="w3-dropdown-hover w3-hover-none">
                        <button class="w3-button"><i class="fa fa-caret-down"></i></button>
                        <div class="w3-dropdown-content w3-bar-block w3-border">
                            <a href="#" class="w3-bar-item w3-button">View History</a>
                            <a href="#" class="w3-bar-item w3-button">Edit Profile</a>
                            <a href="logout.php" class="w3-bar-item w3-button">Log Out</a>
                        </div>
                    </div>
                </div>
                <button onclick="window.location.href='cart.php'" type="submit"
                    class="w3-card w3-padding w3-round-large w3-dark-blue w3-margin-left">

                    <div class="cart">
                        <label style="font-size:16px;margin-right:2px;margin-left:5px;color:#fff;">Cart :
                            <?php
                                $cnt = count($_SESSION['cart']);
                                echo "<span>$cnt Items</span>";

                                ?>
                        </label>
                </button>
            </div>
        </div>
        </div>

        </div>

        </li>
        </div>
        <div class="w3-container welcome-banner">
            <div class="w3-card-4 w3-half w3-margin w3-padding" style="width:48%">
                <h2><b>My Cart</b></h2>
                <hr>
                <div class="w3-card-4 w3-margin-top" width="45%">
                    <?php
                        if (isset($_SESSION['cart'])) {
                            $product_id = array_column($_SESSION['cart'], 'product_id');
                            while ($row = mysqli_fetch_assoc($result3)) {
                                foreach ($product_id as $id) {
                                    if ($row['stock_id'] == $id) {
                        ?>
                    <form method="post" action="?action=remove&id=<?php echo $row['stock_id']; ?>">
                        <header class="w3-container w3-light-grey">
                            <h3><?php echo $row['stock_name']; ?></h3>
                        </header>
                        <div class="w3-container w3-margin-top">
                            <img src="<?php echo "../uploads_images/" . $row['img']; ?>" alt="Avatar"
                                class="w3-left w3-margin-right" style="width:17%">
                            <div class="w3-margin-top">
                                <p style="font-size:1.2rem;margin-top:0.1rem;" class="w3-quarter">Quantity :
                                    <?php echo $row['quantity']; ?> KG</p>
                                <p style="font-size:1.2rem;margin-top:0.1rem;" class="w3-quarter">Total Members : 4</p>
                                <p style="font-size:1.2rem;margin-top:0.1rem;" class="w3-quarter">Total Quantity :
                                    <?php echo $row['quantity'] * 4 ?> KG
                                </p><br>
                                <p style="font-size:1.3rem;margin-top:1.5rem;">Price Per KG :
                                    <?php echo $row['stock_price']; ?> Rupees </p>
                                <p style="font-size:1.4rem;margin-top:0.8rem;"><b>Amount :
                                        <?php echo $row['stock_price'] * $row['quantity'] * 4; ?> Rupees</b></p>
                            </div>
                        </div>
                        <button class="w3-button w3-block w3-margin-top w3-red" name="remove">- Remove</button>
                    </form><br><?php
                                                }
                                            }
                                        }
                                    } else {
                                        echo "<h5>Cart is Empty</h5>";
                                    }

                                                    ?>
                </div>
            </div>
            <!--div class="w3-card-4 w3-half w3-margin w3-padding w3-right" style="width:47%">
                <header class="w3-container w3-round-large w3-margin-top w3-light-grey">
                    <h3>Summery Order</h3>
                </header>
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
                            <h3>Select Your Payment Mode by Clicking on Button</h3>
                            <p>You can pay for your bookings in 2 ways...</p>
                            <h3><b>Please Choose Your Corresponding Option .....</b></h3>
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
            </div -->

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

</body>

</html>
<?php
} else {
    header("location: ../login/login.php");
}
?>