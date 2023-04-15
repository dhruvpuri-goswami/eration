<?php
session_start();
include 'connection.php';
$rcard_no = $_SESSION['rationcard_no'];
$cart = $_SESSION['count'];
if (isset($cart)) {
    echo "<script>alert('If You logged out , Your Product has been Removed from Cart..!')</script>";
    echo "<script>window.location='../Auth/login.php'</script>";
} else {
    echo "<script>alert('Product has been not Removed..!)</script>";
}