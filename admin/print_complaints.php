<?php
	include '../php/connection.php';
	$c_id=$_REQUEST['c_id'];
	$sql="SELECT * FROM tbl_complaint 
    WHERE c_id='$c_id'";
	$result3=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_all($result3,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title> Admin | E-Ration </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="w3-container">
        <div class="w3-center w3-margin">
            <img src="./images/l2.png" width="100px" height="70px" alt="">
            <img src="./images/l1.png" alt="" width="170px" height="70px">
        </div>
        <h2 style="background-color:#0A2558;" class="w3-card w3-text-orange w3-padding-24 w3-round-large w3-center"
            style="text-shadow:1px 1px 0 #444">
            <b>Complaint Details of Complaint Id - <?php echo $c_id; ?></b>
        </h2>
        <div class="w3-container w3-margin">
            <br>
            <p class="w3-large w3-text-dark-blue">
            </p>
            <h4><b>Date : </b><?php date_default_timezone_set("Asia/Kolkata");    echo date("d-m-y");  ?>
                <p class="w3-right"><b>Time : </b><?php echo date("h:i:s a");   ?></p>
            </h4>
            <table class="table w3-margin-top">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>PDS No.</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                $n=1;
                foreach($rows as $row)
                {
                ?>
                    <tr>
                        <td data-label="Complaint ID"><?php echo $c_id; ?></td>
                        <td data-label="Date"><?php echo $row['date']; ?></td>
                        <td data-label="Customer Name"><?php echo $row['u_fname'] ?></td>
                        <td data-label="PDS No.">₹ <?php echo $row['pds_no']; ?></td>
                        <td data-label="Desription"><?php echo $row['description'] ?></td>
                    </tr>
                    <?php
                    $n=$n+1;
                }
                ?>
                </tbody>
            </table>
            <div class="w3-center">
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" id="home"><a
                        href="check_complaints.php" id="home" style="text-decoration: none;">Home</a></button>
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" onclick="myFunction()"
                    id="printpagebutton">Print Receipt</button>
            </div>
        </div>
        <script>
        function myFunction() {
            var printButton = document.getElementById("printpagebutton");
            var home = document.getElementById("home");
            printButton.style.visibility = 'hidden';
            home.style.visibility = "hidden";
            window.print()
            printButton.style.visibility = 'visible';
            home.style.visibility = "visible";
        }
        </script>
    </div>
    </div>
</body>

</html>