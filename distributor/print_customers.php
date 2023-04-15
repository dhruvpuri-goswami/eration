<?php
    session_start();
    if(isset($_SESSION['rationcard_no']))
    {
    $rcard_no=$_SESSION['rationcard_no'];
    $d_pincode=$_REQUEST['pincode'];
    include ('../php/connection.php');
    $sql1="SELECT * FROM tbl_user WHERE pincode='$d_pincode'";
    $result1=mysqli_query($conn,$sql1);
    $d_customers=mysqli_fetch_all($result1,MYSQLI_ASSOC);
    $sql2="SELECT * FROM tbl_distributor WHERE rationcard_no='$rcard_no'";
    $result2=mysqli_query($conn,$sql2);
    $d_pds=mysqli_fetch_assoc($result2);
    $n=1;
        $pds=$d_pds['pds_no'];
    ?>
<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title> Distributor | E-Ration </title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
        .table{
        width: 50%;
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
        }

        .table thead{
        background-color:#0A2558;
        }

        .table thead tr th{
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.35px;
        color: #ffffff;
        opacity: 1;
        padding: 12px;
        vertical-align: top;
        border: 1px solid #dee2e685;
        }

        .table tbody tr td{
        font-size: 14px;
        font-weight: normal;
        letter-spacing: 0.35px;
        padding: 8px;
        text-align: center;
        border: 1px solid #dee2e685;
        }
        </style>
    </head>
    <body>
    <div class="w3-container w3-center">
		<h2 style="margin-top: 50px;">E-Ration</h2>
		<h4 style="margin-top: -10px;">Customer Details Under PDS NO-<?php echo $pds; ?></h4>
		<h5>Date:<?php 
    date_default_timezone_set("Asia/Kolkata");
    echo date("d-m-y")."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Time: ".date("h:i:s a"); ?></h5>	
	</div>
    <table class="table">
        <thead>
             <tr>
                <th>SR No</th>
                <th>Name</th>
                <th>Ration Card No</th>
                <th>Aadhar Card No</th>
                <th>DOB</th>
                <th>Email-id</th>
                <th>Phone No</th>
                <th>Pincode</th>
                <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($d_customers as $d_customer)
                {
                ?>
                <tr>
                    <td data-label="SR No"><?php echo $n; ?></td>
                    <td data-label="Name"><?php echo $d_customer['fname']." ".$d_customer['mname']." ".$d_customer['lname']; ?></td>
                    <td data-label="Ration Card No"><?php echo $d_customer['rationcard_no']; ?></td>
                    <td data-label="Aadhar Card No"><?php echo $d_customer['aadhar_no']; ?></td>
                    <td data-label="DOB"><?php echo $d_customer['dob']; ?></td>
                    <td data-label="Email-id"><?php echo $d_customer['email_id']; ?></td>
                    <td data-label="Phone No"><?php echo $d_customer['contact_no']; ?></td>
                    <td data-label="Pincode"><?php echo $d_customer['pincode']; ?></td>
                    <td data-label="Address"><?php echo $d_customer['address']; ?></td>
                </tr>
                <?php
                    $n++;
                }
            ?>
            </tbody>
        </table>
        <button type="submit" onclick="myFunction()" id="printpagebutton" style="font-size:24px;margin-left: 47%;
        margin-top:10px;margin-bottom: 10px;background-color: #0A2558;color: white;">Print <i class="material-icons"></i></button>
		<script>
			function myFunction() {
				var printButton = document.getElementById("printpagebutton");
					
					printButton.style.visibility = 'hidden';
					
					window.print()
					printButton.style.visibility = 'visible';
			}
		</script>
    </body>
  </html>
  <?php
}
else
{
	header("location: ../login/login.php");
}
?>