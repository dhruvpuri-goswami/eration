<?php 
    session_start();
    require './vendor/autoload.php';
    use Razorpay\Api\Api;
	if(isset($_SESSION['rationcard_no']))
    {
    include 'config.php';
    $rcard_no=$_SESSION['rationcard_no'];
	$total_amt=$_SESSION['total_amount'];
    $price=$total_amt/75;
    include 'connection.php';
    $sql="SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
    $result=mysqli_query($conn,$sql);
    $user_details=mysqli_fetch_assoc($result);
    $u_id=$user_details['u_id'];
    
	$sql3 = "SELECT * FROM tbl_stock";
    $result3 = mysqli_query($conn, $sql3);
    $amt=0;
    $n=1;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>E-Ration</title>
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
    .form-payment{
        width: 100%;
        display: flex;
        justify-content: center;
    } 
    .razorpay-payment-button{
        padding: 14px 20px;
        background-color: #0a2558;
        color: white;
        border-radius: 8px;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="w3-center w3-margin">
            <img src="l2.png" width="100px" height="70px" alt="">
            <img src="l1.png" alt="" width="170px" height="70px">
        </div>
        <h2 class="w3-text-orange w3-dark-blue w3-padding-24 w3-round-large w3-center"
            style="text-shadow:1px 1px 0 #444">
            <b>Online Payment</b>
        </h2>
        <div class="w3-container w3-margin">
            <h4><b>Date : </b><?php date_default_timezone_set("Asia/Kolkata");    echo date("d-m-y");  ?>
                <p class="w3-right"><b>Time : </b><?php echo date("h:i:s a");   ?></p>
            </h4>
            <br>
            <p class="w3-large w3-text-dark-blue">
                <b><?php echo "Dear, ". $user_details['fname']." ". $user_details['mname']." ". $user_details['lname'];?>
                    <br></b>
            </p>
            <p class="w3-margin-top w3-large"><b>Your Amount : </b>
                <?php echo "Rs. ".$total_amt.".00";?></p><br>
            <table class="table w3-margin-top">
                <thead>
                    <tr>
                        <th>SR No.</th>
                        <th>Item Name</th>
                        <th>Item Quantity</th>
                        <th>Item Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($_SESSION['cart'])) {
                            if (count($_SESSION['cart']) >= 1) {
                                $product_id = array_column($_SESSION['cart'], 'product_id');
                                while($row = mysqli_fetch_assoc($result3)) {
                                    foreach ($product_id as $id) {
                                        $stock_id=$row['stock_id'];
                                       if ($stock_id == $id) {
                                        $total=$row['stock_price'] * $row['quantity'] * 4;
                        ?>
                    <tr>
                        <td data-label="SR No."><?php echo $n; ?></td>
                        <td data-label="Item Name"><?php echo $row['stock_name']; ?></td>
                        <?php
                                    if($row['stock_name']!="Oil")
                                    {
                                    ?>
                        <td data-label="Quantity"><?php echo ($row['quantity'] * 4)."/KG"; ?></td>
                        <?php
                                    }
                                    else
                                    {?>
                        <td data-label="Quantity"><?php echo ($row['quantity'] * 4)."/Litres"; ?></td>
                        <?php } ?>
                        <td data-label="Price"><?php echo $total; ?></td>
                    </tr>
                    <?php
                                        $n++;
                                        $amt=$amt+$total;
                                        ?>
                    <?php
                            }
                            
                            
                                                }    
                                        }
                                        echo "<tr>";
                                            echo "<td colspan='3'><b>Total</b></td>";
                                            echo "<td><b> $amt</b></td>";
                                        echo "</tr>";
                                        } 
                                        
                                        else {
                                            echo "<tr>";
                                            echo "<td colspan='4'><b>Cart is Empty</b></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                            echo "<td colspan='4'><b>Cart is Empty</b></td>";
                                            echo "</tr>";
                                    }

                                                        ?>
                </tbody>
            </table>
        </div>
        <?php
            if (isset($_SESSION['cart'])) {
                $product_id = array_column($_SESSION['cart'], 'product_id');
                $total="";
                foreach($product_id as $id)
                {
                    $total=$total.$id;
                }
            }
            date_default_timezone_set("Asia/Calcutta");
            $date = date("Y-m-d");
            //inserting into book table
            $sql2="INSERT INTO tbl_book (rationcard_no, date, amount, items)
            VALUES ('$rcard_no', '$date', '$amt', '$total')";
            mysqli_query($conn,$sql2);
            ?>

        <div class="w3-padding-32 w3-center w3-margin-top" style="font-size: 48px;">
            <i class="fa fa-cc-visa" style="color:navy;"></i>
            <i class="fa fa-cc-amex" style="color:blue;"></i>
            <i class="fa fa-cc-mastercard" style="color:red;"></i>
            <i class="fa fa-cc-discover" style="color:orange;"></i>
        </div>
        </table>


        <?php
    

        $api = new Api('rzp_test_aRU1rjyM5pOCdU', 'rnQn3k3jgkU7ii2rgIPjdBvX');

        $orderId = "ORDER_" . rand(); // a unique identifier for the order
        $callbackUrl = "https://example.com/callback"; // the URL to redirect to after payment

        $order = $api->order->create([
            'amount' => $amt * 100,
            'currency' => 'INR',
            'receipt' => $orderId,
            'payment_capture' => 1,
            'notes' => [
                'callback_url' => $callbackUrl,
            ],
        ]);

        $_SESSION['order'] = $order;

        $razorpayPaymentId = ''; // store this value in your database or session

        // create a HTML button that will redirect the user to the Razorpay payment page
        echo '<form class="form-payment" action="./receipt2.php" method="POST">
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="' . 'rzp_test_aRU1rjyM5pOCdU' . '"
                data-amount="' . $amt . '"
                data-currency="INR"
                data-order_id="' . $order->id . '"
                data-buttontext="Pay with Razorpay"
                data-name="My Store"
                data-description="Order #"'.$orderId.'"
                data-image="../images/logo.png"
                data-prefill.name="E-Ration"
                data-prefill.email="eration@gmail.com"
                data-theme.color="#F37254"></script>
        <input type="hidden" name="razorpay_payment_id" value="' . $razorpayPaymentId. '">
        </form>'; ?>
        
    </div>
</body>

</html>
<?php
}
else
{
	header("location: ../login/login.php");
}
?>