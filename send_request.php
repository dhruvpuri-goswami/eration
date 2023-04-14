<?php
    //session_start();
    include 'connection.php';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $post_name=$_POST['Name'];
        $post_date=$_POST['Date'];
        $post_email=$_POST['Email'];
        $post_subject=$_POST['Subject'];
        $post_message=$_POST['Message'];
        $sql = "INSERT INTO tbl_send_request(name,date,email,subject,message) VALUES ('$post_name', '$post_date' , '$post_email', '$post_subject', '$post_message')";
        if (!mysqli_query($conn, $sql))
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        else
        {
            sleep(2);
            echo '<script>
            alert("Your Request has been submitted...");
            window.location.href="index.php";
            </script>';
        }
    }
?>