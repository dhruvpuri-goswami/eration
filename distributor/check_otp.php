<?php
    session_start();
    $otp=$_SESSION['otp'];
    $b_id=$_SESSION['b_id'];
    if(isset($_REQUEST['btnotp']))
    {
        $e_otp=$_REQUEST['otp'];
        if($otp==$e_otp)
        {
            include '../php/connection.php';
            $sql="UPDATE tbl_book SET authentication='1' WHERE booking_id='$b_id'";
            $sql1="SELECT * FROM tbl_book WHERE booking_id='$b_id'";
            $result1=mysqli_query($conn,$sql1);
            $data=mysqli_fetch_assoc($result1);
            $rc=$data['rationcard_no'];
            if(mysqli_query($conn,$sql))
            {?>
<script>
alert("You are authenticated!!");
window.location.href = "list_customer.php?c_rc=<?php echo $rc; ?>";
</script>'
<?php
            }
            else
            {
                echo "<script>alert('Something Went Wrong!!')</script>";
            }
        }
    }
?>