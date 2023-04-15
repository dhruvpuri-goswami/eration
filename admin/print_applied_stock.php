<?php
	include '../php/connection.php';	
	$ap_id=$_REQUEST['sr_id'];
    $sql2="SELECT tbl_apply_stock.ap_id ,tbl_apply_stock.date ,tbl_stock.stock_id ,tbl_stock.stock_name, tbl_distributor.fname,
    tbl_distributor.mname, tbl_distributor.lname, tbl_distributor.pds_no, tbl_apply_stock.quantity, tbl_apply_stock.status
	FROM tbl_stock, tbl_distributor, tbl_apply_stock 
    WHERE tbl_apply_stock.pds_no=tbl_distributor.pds_no AND tbl_apply_stock.stock_id=tbl_stock.stock_id AND tbl_apply_stock.ap_id='$ap_id'
	ORDER BY tbl_apply_stock.ap_id";
    $result2=mysqli_query($conn,$sql2);
    $rows=mysqli_fetch_all($result2,MYSQLI_ASSOC);
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
            <b>Applied Stock Details of Applied Id - <?php echo $ap_id; ?></b>
        </h2>
        <div class="w3-container w3-margin">
            <br>
            <p class="w3-large w3-text-dark-blue">
            </p>
            <h4><b>Date : </b><?php date_default_timezone_set("Asia/Kolkata");    echo date("d-m-y");  ?>
                <p class="w3-right"><b>Time : </b><?php echo date("h:i:s a");   ?></p>
            </h4>
            <?php
                    foreach($rows as $row)
                    {
                ?>
            <p class="w3-large w3-text-dark-blue">
                <b><?php echo "Dear, ". $row['fname']." ".$row['mname']." ".$row['lname'];?> <br></b>
            </p>
            <table class="table w3-margin-top">
                <thead>
                    <tr>
                        <th>Applied ID</th>
                        <th>Date</th>
                        <th>PDS No.</th>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <?php 
						if($row['status']=="no")
						{
					?>
                        <th>Approve Stock</th>
                        <?php
						}
						?>

                        <th>Status</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="w3-padding" data-label="Applied ID"><?php echo $ap_id; ?></td>
                        <td data-label="Date" class="w3-padding"><?php echo $row['date']; ?></td>
                        <td data-label="PDS No." class="w3-padding"><?php echo $row['pds_no']; ?></td>
                        <td data-label="Item ID" class="w3-padding"><?php echo $row['stock_id']; ?></td>
                        <td data-label="Item Name" class="w3-padding"><?php echo $row['stock_name']; ?></td>
                        <?php
                    if($row['stock_name']!="Oil")
                    {
                    ?>
                        <td data-label="Quantity" class="w3-padding"><?php echo $row['quantity']." KG"; ?></td>
                        <?php
                    }
                    else
                    {
                    ?>
                        <td data-label="Quantity" class="w3-padding"><?php echo $row['quantity']." Litre"; ?></td>
                        <?php
                    }
                    ?>
                        <?php
						if($row['status']=="no")
						{
					?>
                        <td class="w3-padding">
                            <form action="approve_stock.php" method="post">
                                <input type="radio" name="check" value="yes">&nbsp;Yes&nbsp;&nbsp;
                                <input type="radio" name="check" value="no">&nbsp;No&nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="sr_id" value="<?php echo $ap_id; ?>">
                                <input type="hidden" name="iname" value="<?php echo $row['stock_name']; ?>">
                                <input type="hidden" name="quan" value="<?php echo $row['quantity']; ?>">
                                <input type="hidden" name="pds" value="<?php echo $row['pds_no']; ?>">
                                <button class="w3-padding w3-dark-blue w3-button w3-round-large"
                                    name="btn-approve">Approve</button>
                            </form>
                        </td>
                        <?php
						}
					?>
                        <td data-label="Status"><?php echo $row['status']; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="w3-center">
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" id="home"><a
                        href="applied_stock.php" style="text-decoration: none;">Home</a></button>
                <button type="button" style="background-color:#0A2558;"
                    class="w3-button w3-round-large w3-text-white w3-padding w3-margin-top" onclick="myFunction()"
                    id="printpagebutton">Print Receipt</button>
            </div>
        </div>

        <?php
                    }
                ?>
        </table>
        <script>
        function myFunction() {
            var printButton = document.getElementById("printpagebutton");

            printButton.style.visibility = 'hidden';

            window.print()
            printButton.style.visibility = 'visible';
        }
        </script>
    </div>
    </div>
</body>

</html>