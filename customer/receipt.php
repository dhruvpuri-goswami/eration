<?php
    session_start();
    include 'config.php';
        $rcard_no=$_REQUEST['rationcard_no'];
        $total_amt=$_REQUEST['total_amount'];
        $tid=$_REQUEST['tid'];
        include 'connection.php';
        $sql="SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_fetch_assoc($result);
        $u_id=$rows['u_id'];
        $u_name=$rows['fname']." ". $rows['mname']." ". $rows['lname'];

        $sql2="SELECT * FROM tbl_receipt WHERE tid='$tid'";
        $result2=mysqli_query($conn,$sql2);
        $receipt_info=mysqli_fetch_assoc($result2);
        $b_id=$receipt_info['booking_id'];
        $sql4="SELECT * FROM tbl_book WHERE booking_id='$b_id'";
        $result4=mysqli_query($conn,$sql4);
        $details=mysqli_fetch_assoc($result4);
        $total_amount=0;
        $n=1;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Receipt | E-Ration</title>
    <link rel="stylesheet" href="style.css?v=<?=$v?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
    .invoice-box {
        max-width: 1000px;
        margin: auto;
        margin-top: 50px;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        border-radius: 20px;
    }
    </style>
</head>

<body>
    <div class="w3-container">
        <div class="w3-center w3-margin">
            <img src="l2.png" width="100px" height="70px" alt="">
            <img src="l1.png" alt="" width="170px" height="70px">
        </div>
        <h2 class="w3-text-orange w3-dark-blue w3-padding-24 w3-round-large w3-center"
            style="text-shadow:1px 1px 0 #444">
            <b>Payment Receipt</b>
        </h2>
        <div class="w3-container w3-margin">
            <br>
            <p class="w3-large w3-text-dark-blue"><b><?php echo "Dear, ". $u_name;?> <br></b></p>
            <h4><b>Date : </b><?php date_default_timezone_set("Asia/Kolkata");    echo date("d-m-y");  ?>
                <p class="w3-right"><b>Time : </b><?php echo date("h:i:s a");   ?></p>
            </h4>
            <h4><b>Receipt ID : </b><?php echo $receipt_info['receipt_id'];  ?>
                <p class="w3-right"><b>Transection ID : </b><?php echo $tid;   ?></p>
            </h4>
            <h4>
                <p class=""><b>Mode of Payment: </b><?php echo "Online";   ?></p>
            </h4>
            <table class="table w3-margin-top">
                <thead>
                    <tr>
                        <th>SR No.</th>
                        <th>Item Id</th>
                        <th>Item Name</th>
                        <th>Item Quantity</th>
                        <th>Item Price</th>
                    </tr>
                </thead>
                <?php
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
                                            $reverse = floor($reverse/10);
                            ?>
                <tr>
                    <td data-label="SR No."><?php echo $n; ?></td>
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
                                ?>
                <tr>
                    <td colspan="4" style="text-align: center;"><b>Total</b></td>
                    <td><b><?php echo "₹ ". $total_amount; 
                                ?></b></td>
                </tr>
                </tbody>
            </table>
            <div class="w3-center">
                <button type="button" class="w3-button w3-round-large w3-dark-blue w3-padding w3-margin-top"><a
                        href="customer.php" style="text-decoration: none;">Home</a></button>
                <button type="button" class="w3-button w3-round-large w3-dark-blue w3-padding w3-margin-top"
                    onclick="myFunction()" id="printpagebutton">Print Receipt</button>
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
        </table>
    </div>
</body>

</html>