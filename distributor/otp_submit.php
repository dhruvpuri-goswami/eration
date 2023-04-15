<?php
    session_start();
    $member=$_REQUEST['mem'];
    $mail=$_REQUEST['mail'];
    $otp=rand(1000,9999);
    $subject = "Verification of Ration";
    $message = "<b><h1>E-Ration Team.</h1></b>";
    $message .= "<h4>Your ration is taking by $member.</h4>";
    $message .= "<h4>OTP is $otp.</h4>";
                            
    $header = "From:nallaabhi2003@gmail.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
                                
    $retval = mail ($mail,$subject,$message,$header);
    if($retval)
    {
        $_SESSION['otp']=$otp;
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

</body>

</html>
<form class="w3-display-middle w3-container w3-card-4" style="width: 35%;" action="check_otp.php" method="post">
    <p><label>OTP</label>
        <input class="w3-input w3-border" name="otp" type="number" maxlength="4" placeholder="Enter OTP" required>
    </p>
    <button type="submit" name="btnotp" class="w3-center w3-padding w3-button w3-green w3-round-large w3-margin">
        Submit
    </button>
</form>
<?php                
    }
?>