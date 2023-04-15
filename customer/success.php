<?php
    include 'connection.php';
    $tid = $_POST['txn_id'];
    $penalty = $_POST['payment_gross'];
    $price=$penalty*75;
    $dollar=$price/75;
    if($penalty == $dollar)
    {
        $int=$price;
    }
    $state = $_POST['payment_status'];
    $payer_id = $_POST['payer_id'];
    $rcard_no = $_POST['item_name'];
    $u_id = $_POST['item_number'];	
    date_default_timezone_set("Asia/Calcutta");
    $date = date("Y-m-d");
    $time = date("H:i:s");          
    

    //fetching bookin_id
    $sql1="SELECT * FROM tbl_book WHERE rationcard_no='$rcard_no' AND date='$date'";
    $result1=mysqli_query($conn,$sql1);
    $booking=mysqli_fetch_assoc($result1);
    $booking_id=$booking['booking_id'];

    //inserting into payment table with refernece to booking_id
    $sql2="INSERT INTO tbl_payment (mode, date, time, amount, booking_id)
    VALUES ('Online', '$date', '$time', '$int', '$booking_id')";
    mysqli_query($conn,$sql2);

    //fetching distributor id with pincode and customer pincode
    $sql3="SELECT * FROM tbl_user WHERE u_id='$u_id'";
    $result3=mysqli_query($conn,$sql3);
    $user_info=mysqli_fetch_assoc($result3);
    $u_pincode=$user_info['pincode'];
    $u_name=$user_info['fname']." ". $user_info['mname']." ". $user_info['lname'];
    $u_ph=$user_info['contact_no'];
    $sql4="SELECT * FROM tbl_distributor WHERE pincode='$u_pincode'";
    $result4=mysqli_query($conn,$sql4);
    $dist_info=mysqli_fetch_assoc($result4);
    $d_id=$dist_info['d_id'];

    //inserting into receipt table
    $sql5="INSERT INTO tbl_receipt (u_name, u_contact_no, amount, rationcard_no, date, time, tid, state, d_id, booking_id)
    VALUES ('$u_name', '$u_ph', '$int', '$rcard_no', '$date', '$time', '$tid', '$state', '$d_id', '$booking_id')";
    if(mysqli_query($conn,$sql5))
    {  
        //fetching receipt_id from receipt table
        $sql6="SELECT * FROM tbl_receipt WHERE tid='$tid'";
        $result6=mysqli_query($conn,$sql6);
        $r_info=mysqli_fetch_assoc($result6);
        $r_id=$r_info['receipt_id'];

        //updating booking status
        $sql7="UPDATE tbl_book SET status=1 WHERE booking_id='$booking_id'";
        if(mysqli_query($conn,$sql7))
        {
            //here comes header function which redirects to receipt printing page
            header("Location: receipt.php?tid=$tid&total_amount=$int&rationcard_no=$rcard_no");
        }
        else
        {
            echo '<script>alert("Something Went Wrong")</script>';
        }

        
    }
?>