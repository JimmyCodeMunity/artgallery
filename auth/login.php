<?php
@include('../connection/connect.php');
session_start();
error_reporting(1);
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);


    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {
        if ($row['user_type'] == 'seller') {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['logged_in'] = true;
            $_SESSION['seller'] = true;
            header('location:../sellerdash/index.php');
        } elseif ($row['user_type'] == 'buyer') {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['logged_in'] = true;
            $_SESSION['buyer'] = true;
            header('location:../user.php');
        }
    } else {
        echo "<script>
            var result = confirm('Incorrect email or password');
            if (result) {
                window.location.href = '../index.php'; // Redirect to the login page
            } else {
                // Stay on the same page or perform other actions
            }
        </script>";
    }
}
