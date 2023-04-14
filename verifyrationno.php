<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Verify Ration Number | E-Ration </title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form action="" method="post">
        <div class="w3-display-middle w3-card w3-round-large w3-xlarge w3-light-grey w3-padding-32">
            <div class="w3-card w3-margin w3-xlarge w3-round-large w3-padding w3-text-white"
                style="background: linear-gradient(#00545d , #000729);">
                Verify Your Ration Number
            </div>
            <div class="w3-container w3-large w3-padding w3-margin">
                <label>Ration Card No :</label>
                <input class="w3-input w3-margin-top" placeholder="Enter Rationcard No" name="rcard_no" type="number">
            </div>
            <div class="w3-center w3-margin-top">
                <button class="w3-button w3-hover-text-white w3-margin-top w3-large w3-round-large"
                    style="background:linear-gradient(#00545d , #000720);color:white;" name="btnsubmit">Verify
                    Now</button>
            </div>
        </div>
    </form>
    <?php
        if(isset($_REQUEST['btnsubmit']))
        {
            $rcard=$_REQUEST['rcard_no'];
            include 'connection.php';
            $sql="SELECT rationcard_no FROM tbl_ration WHERE rationcard_no='$rcard'";
            $result=mysqli_query($conn,$sql);
            $fetch=mysqli_fetch_assoc($result);
            $count=mysqli_num_rows($result);
            if($count>=1)
            {?>
    <script>
    alert("Entered Ration number is verified.");
    window.location.href = "../eration/login/signup.php?rcard=" + <?php echo $rcard; ?>;
    </script>';
    <?php
            }
            else
            {
                echo '<script>
                alert("Entered Ration number is not correct. Please Verify Once");
                window.location.href="verifyrationno.php";
                </script>';
            }
        }
  ?>

</body>

</html>