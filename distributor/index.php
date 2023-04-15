<?php
  $rcard_no=$_REQUEST['rc_no'];
  include '../php/connection.php';
  $sql="SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
  $result=mysqli_query($conn,$sql);
  $distributors=mysqli_fetch_all($result,MYSQLI_ASSOC);
  foreach($distributors as $distributor)
  {
    $d_pincode=$distributor['pincode'];
  }


  $sql1="SELECT tbl_user.*, tbl_distributor.pincode AS distributor_pincode FROM tbl_user, 
  tbl_distributor WHERE tbl_user.pincode='$d_pincode'
  AND tbl_distributor.pincode='$d_pincode'";
  $result3=mysqli_query($conn,$sql1);
  $complaints=mysqli_num_rows($result3);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Distributor Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
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
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Check Available Stock</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Apply For Stock</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Analytics</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-user' ></i>
            <span class="links_name">Customers</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Recent Transections</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Edit Profile</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
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
        <img src="images/profile.jpg" alt="">
        <span class="admin_name">Abhishek Nalla</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Customers</div>
            <div class="number"><?php echo $complaints; ?></div>
          </div>
          <i class='bx bxs-user-account cart four'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Sales</div>
            <div class="number">9,876</div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Profit</div>
            <div class="number">12,876</div>
          </div>
          <i class='bx bx-cart cart three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Return</div>
            <div class="number">11,086</div>
          </div>
          <i class='bx bxs-user-account cart four' ></i>
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Recent Sales</div>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">Date</li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
            </ul>
            <ul class="details">
            <li class="topic">Customer</li>
            <li><a href="#">Amit Shah</a></li>
            <li><a href="#">Nilesh Suthar</a></li>
            <li><a href="#">Kaushik Gaddam</a></li>
            <li><a href="#">Vijay Sharma</a></li>
            <li><a href="#">Mayank Agrwal</a></li>
            <li><a href="#">Sanjay Mehta</a></li>
            <li><a href="#">Nirmal joshi</a></li>
            <li><a href="#">Raj Kundra</a></li>
             <li><a href="#">Tushar Shetty</a></li>
          </ul>
          <ul class="details">
            <li class="topic">Sales</li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Pending</a></li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Delivered</a></li>
            <li><a href="#">Pending</a></li>
            <li><a href="#">Pending</a></li>
            <li><a href="#">Delivered</a></li>
             <li><a href="#">Pending</a></li>
            <li><a href="#">Delivered</a></li>
          </ul>
          <ul class="details">
            <li class="topic">Total</li>
            <li><a href="#">204.98</a></li>
            <li><a href="#">24.55</a></li>
            <li><a href="#">25.88</a></li>
            <li><a href="#">170.66</a></li>
            <li><a href="#">56.56</a></li>
            <li><a href="#">44.95</a></li>
            <li><a href="#">67.33</a></li>
             <li><a href="#">23.53</a></li>
             <li><a href="#">46.52</a></li>
          </ul>
          </div>
          <div class="button">
            <a href="#">See All</a>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Customers</div>
          <ul class="top-sales-details">
            <li>
            <a href="#">
              <img src="images/sunglasses.jpg" alt="">
              <span class="customer">Nilesh Suthar</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/jeans.jpg" alt="">
              <span class="customer">Vijay Sharma </span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/nike.jpg" alt="">
              <span class="customer">Karan Shah</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/scarves.jpg" alt="">
              <span class="customer">Mahesh Patel</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/blueBag.jpg" alt="">
              <span class="customer">Sandip Mali</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/bag.jpg" alt="">
              <span class="customer">Kaushik Gaddam</span>
            </a>
          <li>
            <a href="#">
              <img src="images/addidas.jpg" alt="">
              <span class="customer">Vikash Parmar</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="images/shirt.jpg" alt="">
              <span class="customer">Naresh Mahajan</span>
            </a>
          </li>
          </ul>
        </div>
      </div>
      </div>
  </section>
  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>
