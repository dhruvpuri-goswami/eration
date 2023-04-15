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

            // $email_query = "SELECT email_id from tbl_user where rationcard_no='".$rcard_no."'";
            // $exctEmailQue = mysqli_query($conn, $email_query);
            // $finalUserEmail = mysqli_fetch_assoc($exctEmailQue)['email_id'];
            // $email = "nayaksahil992003@gmail.com";
            // /*ENTER_FROM_EMAIL_ADDRESS*/
            // $name = "sahil";
            // /*ENTER_A_NAME*/
            // $body = " <html> 
            //             <head> 
            //                 <title>Welcome to CodexWorld</title> 
            //             </head> 
            // <body> Hello <b>" .$rcard_no. "</b>,<br> Thank you for Purchasing item! <br> Here, is your Vefication QR CODE: <br> <img width='300px' src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$r_id."_".$rcard_no.">
            //     </body> 
            //     </html>";

            // $subject = "Account Verification QR Code";

            // $headers = array(
            //     'Authorization: Bearer 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',
            //     /*ENTER_YOUR_API_KEY*/
            //     'Content-Type: application/json',
            //     'MIME-Version: 1.0'
            // );

            // $data = array(
            //     "personalizations" => array(
            //         array(
            //             "to" => array(
            //                 array(

            //                     "email" => $finalUserEmail,
            //                     /*ENTER_TO_EMAIL_ADDRESS*/
            //                     "name"  => $u_name,
            //                 )
            //             )
            //         )
            //     ),
            //     "from" => array(
            //         "email" => $email
            //     ),

            //     "subject" => $subject,
            //     "content" => array(
            //         array(
            //             "type" => "text/html",
            //             "value" => $body
            //         )
            //     )
            // );

            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
            // curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $_SESSION['ration_number'] = $rcard_no;
            // $response = curl_exec($ch);
            // curl_close($ch);
            // echo $response;
            // echo json_encode(array("status"=>200,"msg"=>"Successfull"));
            //here comes header function which redirects to receipt printing page
            header("Location:qrcode.php?receipt_id=$r_id&rationcard=$rcard_no");
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