<?php
    session_start();
    if(isset($_SESSION['rationcard_no']))
    {    
        include 'connection.php';
        $rcard_no = $_SESSION['rationcard_no'];
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d");
        $time = date("H:i:s");          
        $int=$_SESSION['total_amount'];
        $state="Incomplete";
        
        if (isset($_SESSION['cart'])) {
            $product_id = array_column($_SESSION['cart'], 'product_id');
            $total="";
            foreach($product_id as $id)
            {
                $total=$total.$id;
            }
        }

        //inserting into book table
        $sql="INSERT INTO tbl_book (rationcard_no, date, amount, items)
        VALUES ('$rcard_no', '$date', '$int', '$total')";
        mysqli_query($conn,$sql);

        //fetching bookin_id
        $sql1="SELECT * FROM tbl_book WHERE rationcard_no='$rcard_no' AND date='$date'";
        $result1=mysqli_query($conn,$sql1);
        $booking=mysqli_fetch_assoc($result1);
        $booking_id=$booking['booking_id'];

        //inserting into payment table with refernece to booking_id
        $sql2="INSERT INTO tbl_payment (mode, date, time, amount, booking_id)
        VALUES ('Offline', '$date', '$time', '$int', '$booking_id')";
        mysqli_query($conn,$sql2);

        //fetching distributor id with pincode and customer pincode
        $sql3="SELECT * FROM tbl_user WHERE rationcard_no='$rcard_no'";
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
        $sql5="INSERT INTO tbl_receipt (u_name, u_contact_no, amount, rationcard_no, date, time, state, d_id, booking_id)
        VALUES ('$u_name', '$u_ph', '$int', '$rcard_no', '$date', '$time', '$state', '$d_id', '$booking_id')";
        if(mysqli_query($conn,$sql5))
        {  
            $sql6="SELECT * FROM tbl_receipt WHERE date='$date' AND time='$time' AND rationcard_no='$rcard_no'";
            $result6=mysqli_query($conn,$sql6);
            $r_info=mysqli_fetch_assoc($result6);
            $r_id=$r_info['receipt_id'];
            //here comes header function which redirects to receipt printing page
            header("Location:receipt1.php?r_id=$r_id");
        }
        else
        {
            echo '<script>alert("Something Went Wrong")</script>';
        }
    }
    else
    {
        header("location: ../login/login.php");
    }
?>