<?php 
    session_start();
    if(isset($_SESSION['rationcard_no']))
    {
        include 'config.php'; 
        $rcard_no=$_SESSION['rationcard_no'];
        include 'connection.php';
        $sql = "SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $name = $rows['fname'] . " " . $rows['mname'] . " " . $rows['lname'];
        $image=$rows['image'];
?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css?v=<?=$v?>">
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
                        <a href="mycart.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Book Ration</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
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
                <i class='bx bx-bell icon'></i>
                <span class="dashboard">Transactions</span>
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
        <div class="welcome-banner  w3-container w3-margin-left">
            <ul class="w3-ul w3-dark-blue w3-card-4 w3-round-large">
                <li class="w3-bar">
                    <img src="<?php echo "../uploads_images/" . $image; ?>" alt="Error"
                        class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
                    <div class="w3-bar-item">
                        <span class="w3-large">Hello
                            <?php echo $name; ?>,</span><br>
                        <span>Welcome to the E-Ration...</span>
                    </div>
                </li>
            </ul>
            <h2 class="w3-center w3-margin-top">Payment History</h2>
            <table class="table w3-margin-top">
                <thead>
                    <tr>
                        <th>SR No.</th>
                        <th>Date</th>
                        <th>Mode of Payment</th>
                        <th>Amount</th>
                        <th>Booking ID</th>
                        <th>Reference ID</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $sql1="SELECT * from tbl_receipt where rationcard_no = '$rcard_no'";
                $result1=mysqli_query($conn,$sql1);
                $trans=mysqli_fetch_all($result1,MYSQLI_ASSOC);
                $cnt=mysqli_num_rows($result1);
                $n=1;
                if($cnt>=1)
                {
                    foreach($trans as $stat)
                    {
                    ?>
                    <tr>
                        <td data-label="SR No."><?php echo $n; ?></td>
                        <td data-label="Date"><?php echo $stat['date']; ?></td>
                        <td data-label="State of Payment"><?php echo $stat['state']; ?></td>
                        <td data-label="Amount"><?php echo $stat['amount']; ?></td>
                        <td data-label="Booking ID"><?php echo $stat['booking_id']; ?></td>
                        <?php
                            if(isset($stat['tid']))
                            {
                        ?>
                        <td data-label="Reference ID"><?php echo $stat['tid']; ?></td>
                        <?php
                            }
                            else
                            {
                                ?>
                        <td data-label="Reference ID">Offline Payment</td>
                        <?php

                            }
                        ?>
                        <td data-label=""><a href="receipt1.php?r_id=<?php echo $stat['receipt_id']; ?>"
                                class="btn w3-round-large">Recipt</a></td>
                    </tr>
                    <?php
                        $n++;
                    }
                }
                else
                {?>
                    <tr>
                        <td colspan="7" rowspan="3">No transcantions yet</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
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

</body>

</html>
<?php
}
else
{
	header("location: ../login/login.php");
}
?>