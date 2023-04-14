<?php
include "connection.php";
$sql = "SELECT count(*) as count1 FROM tbl_user";

$run = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($run))
{
  print_r(count1);
}
?>