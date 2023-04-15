<?php
session_start();
if(isset($_SESSION['user']))
{
	?>
<?php
      include ('../php/connection.php');
      $sql2="SELECT * FROM `tbl_stock`";
      $result3=mysqli_query($conn,$sql2);
      $rows=mysqli_fetch_all($result3,MYSQLI_ASSOC);
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body>
    <div class="w3-container">
        <div class="w3-center w3-margin">
            <img src="./images/l2.png" width="100px" height="70px" alt="">
            <img src="./images/l1.png" alt="" width="170px" height="70px">
        </div>
        <h2 style="background-color:#0A2558;" class="w3-card w3-text-orange w3-padding-24 w3-round-large w3-center"
            style="text-shadow:1px 1px 0 #444">
            <b>Stock Details</b>
        </h2>
        <div class="w3-container w3-margin">
            <br>
            <p class="w3-large w3-text-dark-blue">
            </p>
            <h4><b>Date : </b><?php date_default_timezone_set("Asia/Kolkata");    echo date("d-m-y");  ?>
                <p class="w3-right"><b>Time : </b><?php echo date("h:i:s a");   ?></p>
            </h4>
            <table class="table w3-margin-top">
                <thead>
                    <tr>
                        <th>SR No.</th>
                        <th>Item Name</th>
                        <th>Item ID</th>
                        <th>Item Price in ₹</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                $n=1;
                foreach($rows as $row)
                {
                ?>
                    <tr>
                        <td data-label="SR No."><?php echo $n; ?></td>
                        <td data-label="Item Name"><?php echo $row['stock_name']; ?></td>
                        <td data-label="Item ID"><?php echo $row['stock_id']; ?></td>
                        <td data-label="Item Price">₹<?php echo $row['stock_price']; ?></td>
                    </tr>
                    <?php
                    $n=$n+1;
                }
                ?>
                </tbody>
            </table>
            <div class="w3-center">
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" id="home"><a
                        href="stock_details.php" style="text-decoration: none;">Home</a></button>
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" onclick="myFunction()"
                    id="printpagebutton">Print Receipt</button>
            </div>
        </div>
        <script>
        function myFunction() {
            var printButton = document.getElementById("printpagebutton");

            printButton.style.visibility = 'hidden';

            window.print()
            printButton.style.visibility = 'visible';
        }
        </script>
</body>

</html>
<?php
}
else
{
	header("location: ../login/admin_login.php");
}
?>