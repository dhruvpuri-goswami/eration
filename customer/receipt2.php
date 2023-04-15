<?php
    require './vendor/autoload.php';
    require_once '../php/connection.php';

    use Razorpay\Api\Api;

    session_start();
    $api = new Api('rzp_test_aRU1rjyM5pOCdU', 'rnQn3k3jgkU7ii2rgIPjdBvX');
    $razorpayPaymentId = $_POST['razorpay_payment_id'];

    $payment = $api->payment->fetch($razorpayPaymentId);

    // print the payment details
    // echo "Amount: " . $payment->amount . "<br>";
    // echo "Status: " . $payment->status . "<br>";
    // echo "Order ID: " . $payment->order_id . "<br>"
    $success;
    $rationcard_no = $_SESSION['rationcard_no'];
    $amount = ($payment->amount)/100;
    $currentDate = date('Y:m:d');
$formattedDate = str_replace(':', '-', $currentDate);

    $sql="INSERT INTO tbl_payment values('$payment->order_id','$payment->id',$amount,'completed',$rationcard_no,$formattedDate)";
    $result = mysqli_query($conn,$sql);

    $success = true;

    $sql2="SELECT * FROM tbl_ration WHERE rationcard_no = '$rationcard_no'";
    $result2 = mysqli_query($conn,$sql2);
    $row = mysqli_fetch_assoc($result2);
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
            <p class="w3-large w3-text-dark-blue"><b><?php echo "Dear, ". $row['m_name'];?> <br></b></p>
            <h4><b>Date : </b><?php date_default_timezone_set("Asia/Kolkata");    echo date("d-m-y");  ?>
                <p class="w3-right"><b>Time : </b><?php echo date("h:i:s a");   ?></p>
            </h4>
            <h4><b>Ration Card No : </b><?php echo $rationcard_no;  ?>
                <p class="w3-right"><b>Phone No : </b><?php echo $row['mobile_no'];   ?></p>
            </h4>
            <table class="table w3-margin-top">
                <thead>
                    <tr class="w3-center">
                        <th>SR No.</th>
                        <th>Date</th>
                        <th>Mode of Payment</th>
                        <th>Amount</th>
                        <!-- <th>Booking ID</th>
                        <th>Reference ID</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="SR No."><?php echo 1; ?></td>
                        <td data-label="Date"><?php echo $payment->created_at; ?></td>
                        <td data-label="Mode of Payment"><?php echo $payment->method; ?></td>
                        <td data-label="Amount"><?php echo $payment->amount/100; ?></td>
                        
                    </tr>
                </tbody>
            </table>
            <div class="w3-center">
                <button type="button" class="w3-button w3-round-large w3-dark-blue w3-padding w3-margin-top"
                    id="home"><a href="customer.php" style="text-decoration: none;">Home</a></button>
                <button type="button" class="w3-button w3-round-large w3-dark-blue w3-padding w3-margin-top"
                    onclick="myFunction()" id="printpagebutton">Print Receipt</button>
            </div>
        </div>
        <script>
        function myFunction() {
            var printButton = document.getElementById("printpagebutton");
            var home = document.getElementById("home");
            printButton.style.visibility = 'hidden';
            home.style.visibility = 'hidden';
            window.print()
            printButton.style.visibility = 'visible';
            home.style.visibility = 'visible';
        }
        </script>
        </table>
    </div>
</body>

</html>