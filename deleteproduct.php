<?php
session_start();
@include('connection/connect.php');

$id = $_GET['artid'];
$user = $_SESSION['email'];

// echo $id;
// echo $user;

$select = "SELECT * FROM art WHERE id = '$id'";
mysqli_query($conn,$select);


$delete = "DELETE FROM testorder WHERE artid = '$id' && buyer = '$user'";
$deleted= mysqli_query($conn,$delete);

if($deleted){
    header("Location:cart.php");
}

?>
