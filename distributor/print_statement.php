<?php
session_start();
if (isset($_SESSION['rationcard_no'])) {
    $date1=$_REQUEST['from'];
    $from = date('Y-m-d', strtotime($date1. ' + 0 days'));
    $date2=$_REQUEST['to'];
    $to = date('Y-m-d', strtotime($date2. ' + 0 days'));
    $rcard_no = $_SESSION['rationcard_no'];
    include '../php/connection.php';
    $sql = "SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
    $result = mysqli_query($conn, $sql);
    $distributors = mysqli_fetch_assoc($result);
    $pds=$distributors['pds_no'];

    $sql2="SELECT * FROM tbl_give_stock WHERE pds_no='$pds' AND date BETWEEN '$from' AND '$to'";
    $result2=mysqli_query($conn,$sql2);
    $buys=mysqli_fetch_all($result2,MYSQLI_ASSOC);
    $cnt1=mysqli_num_rows($result2);

    $sql3="SELECT * FROM tbl_dist_receipt WHERE d_pds='$pds' AND date BETWEEN '$from' AND '$to'";
    $result3=mysqli_query($conn,$sql3);
    $sells=mysqli_fetch_all($result3,MYSQLI_ASSOC);
    $cnt2=mysqli_num_rows($result3);
    $total_buy_quantity=0;
    $total_buy_amount=0;
    $total_sell_quantity=0;
    $total_sell_amount=0;
    $n1=1;
    $n2=1;
?>
<!DOCTYPE html>
<html>

<head>
    <title> Statement | Distributor </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
    }

    .table thead {
        background-color: #0A2558;
    }

    .table thead tr th {
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.35px;
        color: #ffffff;
        opacity: 1;
        padding: 20px;
        vertical-align: top;
        border: 1px solid #dee2e685;
    }

    .table tbody tr td {
        font-size: 14px;
        font-weight: normal;
        letter-spacing: 0.35px;
        padding: 12px;
        text-align: center;
        border: 1px solid #dee2e685;
    }

    .w3-dark-blue,
    .w3-hover-dark-blue:hover {
        color: #fff !important;
        background-color: #0a2558 !important;
    }
    </style>
</head>

<body>
    <div class="w3-container">
        <div class="w3-center w3-margin">
            <img src="./images/l2.png" width="100px" height="70px" alt="">
            <img src="./images/l1.png" alt="" width="170px" height="70px">
        </div>
        <h2 style="background-color:#0A2558;" class="w3-card w3-text-orange w3-padding-24 w3-round-large w3-center"
            style="text-shadow:1px 1px 0 #444">
            <b>Statement of PDS No <?php echo $pds; ?> From <?php echo $date1; ?> to <?php echo $date2; ?></b>
        </h2>
        <div class="w3-container w3-margin">
            <br>
            <p class="w3-large w3-text-dark-blue">
            </p>
            <h4><b>Date : </b><?php date_default_timezone_set("Asia/Kolkata");    echo date("d-m-Y");  ?>
                <p class="w3-right"><b>Time : </b><?php echo date("h:i:s a");   ?></p>
            </h4>
            <h4><b>Name : </b>
                <?php echo $distributors['fname']." ". $distributors['mname']." ". $distributors['lname']; ?>
            </h4>

            <h4><b>PDS No. : </b> <?php echo $pds; ?>
            </h4>
            <hr>
            <h4><b>Total Buy</b>
            </h4>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>SR No</th>
                        <th>Date</th>
                        <th>Item Name</th>
                        <th>Item Price / KG</th>
                        <th>Quantity</th>
                        <th>Total Price in ₹</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($cnt1>0)
                    {
                        foreach($buys as $buy)
                        {
                            $s_name=$buy['stock_name'];
                            $sql1="SELECT * FROM tbl_stock WHERE stock_name='$s_name'";
                            $result1=mysqli_query($conn,$sql1);
                            $prices=mysqli_fetch_assoc($result1);
                            $price=$prices['stock_price'];
                            $t_price=$buy['quantity']*$price;
                    ?>
                    <tr>
                        <td><?php echo $n1; ?></td>
                        <td><?php echo $buy['date']; ?></td>
                        <td><?php echo $s_name; ?></td>
                        <td>
                            <?php echo $price; ?>
                        </td>
                        <td><?php echo $buy['quantity']; ?></td>
                        <td><?php echo $t_price; ?></td>
                    </tr>
                    <?php
                        $total_buy_quantity=$total_buy_quantity+$buy['quantity'];
                        $total_buy_amount=$total_buy_amount+$t_price;
                        $n1++;
                        }
                    ?>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><b>Total Amount</b></td>
                        <td><b><?php echo "₹ ". $total_buy_amount; ?></b></td>
                    </tr>
                    <?php
                    }
                    else
                    {
                        ?>
                    <tr>
                        <td colspan="5">No Transactions in this duration!!</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <hr>
            <h4><b>Total Sell</b>
            </h4>

            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>SR No</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Ration Card No</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($cnt2>0)
                    {
                        foreach($sells as $sell)
                        {
                            $ration=$sell['rationcard_no'];
                            $sql4="SELECT * FROM tbl_user WHERE rationcard_no='$ration'";
                            $result4=mysqli_query($conn,$sql4);
                            $names=mysqli_fetch_assoc($result4);
                            $name=$names['fname']. " ". $names['mname']. " ". $names['lname'];
                    ?>
                    <tr>
                        <td><?php echo $n2; ?></td>
                        <td><?php echo $sell['date']; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $ration; ?></td>
                        <td><?php echo $sell['amount']; ?></td>
                    </tr>
                    <?php
                        $total_sell_amount=$total_sell_amount+$sell['amount'];
                        $n2++;
                        }
                    ?>
                    <tr>
                        <td colspan="4"><b>Total Quantity</b></td>
                        <td><b><?php echo $total_sell_amount; ?></b></td>
                    </tr>
                    <?php
                    }
                    else
                    {
                        ?>
                    <tr>
                        <td colspan="5">No Transactions in this duration!!</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <hr>
            <h4><b>Summery</b>
            </h4>
            <hr>
            <div class="w3-half w3-row-padding" style="color:#0A2558">
                <h4><b>Total Credit<b>
                            <div class="w3-card w3-margin w3-round-large w3-padding w3-text-white"
                                style="background-color:#0a2558;">
                                <b class="w3-margin-top">Total Quantity : </b<br>
                                    <div class="w3-card w3-white w3-margin w3-round-large w3-padding">
                                        <?php echo $total_buy_quantity; ?>
                                    </div>

                                    <b>Total Amount : </b<br>
                                        <div class="w3-card w3-white w3-margin w3-round-large w3-padding">
                                            <?php echo $total_buy_amount." Rupees /-"; ?>
                                        </div>
                            </div>
                </h4>
            </div>

            <div class="w3-half w3-row-padding" style="color:#0A2558">
                <h4><b>Total Debit<b>
                            <?php
                    foreach($sells as $sell)
                    {
                        $b_id=$sell['booking_id'];
                        $sql5="SELECT * FROM tbl_book WHERE booking_id='$b_id'";
                        $result5=mysqli_query($conn,$sql5);
                        $details=mysqli_fetch_assoc($result5);
                        $items=$details['items'];
                        $number = (string) $items;  
                        /* Reverse the string. */  
                        $revstr = strrev($number);  
                        /* writes string into int. */  
                        $reverse = (int) $revstr; 
                        while($reverse>0)
                        {
                            $dig = $reverse%10;
                            $sql5="SELECT * FROM tbl_stock WHERE stock_id='$dig'";
                            $result5=mysqli_query($conn,$sql5);
                            $rows=mysqli_fetch_assoc($result5);
                            $total_sell_quantity=$total_sell_quantity+($rows['quantity']*4);
                            $reverse = floor($reverse/10);
                        }
                    }
                    ?>
                            <div class="w3-card w3-margin w3-darkblue w3-round-large w3-padding w3-text-white"
                                style="background-color:#0a2558;">
                                <b class="w3-margin-top">Total Quantity : </b<br>
                                    <div class="w3-card w3-white w3-margin w3-round-large w3-padding">
                                        <?php echo $total_sell_quantity; ?>
                                    </div>

                                    <b>Total Amount : </b<br>
                                        <div class="w3-card w3-white w3-margin w3-round-large w3-padding">
                                            <?php echo $total_sell_amount." Rupees /-"; ?>
                                        </div>
                            </div>
                </h4>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

            <hr><br>
            <h5>**It is Computer Generated Statement.</h5>
            <h5>**If You have any Query regarding this , then please contact admin.</h5>
            <div class="w3-right w3-margin-right">
                <h4><b>Best Regards From , </b></h4>
                <img src="./images/l2.png" width="50px" height="40px" alt="">
                <img src="./images/l1.png" alt="" width="100px" height="40px">
            </div>
            <br><br><br><br><br>
            <br><br><br>
            <div class="w3-center">
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" id="home"><a
                        href="statement.php" id="home" style="text-decoration: none;">Home</a></button>
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" onclick="myFunction()"
                    id="printpagebutton">Print Receipt</button>
            </div>
            <script>
            function myFunction() {
                var printButton = document.getElementById("printpagebutton");
                var home = document.getElementById("home");

                home.style.visibility = 'hidden';
                printButton.style.visibility = 'hidden';

                window.print()
                home.style.visibility = 'visible';
                printButton.style.visibility = 'visible';
            }
            </script>
        </div>
    </div>
    </div>
</body>

</html>
<?php
} else {
  header("location: ../login/login.php");
}
?>