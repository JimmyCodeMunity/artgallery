<?php
@include('../connection/connect.php');
error_reporting(1);
if (isset($_POST['createaccount'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $type = $_POST['user_type'];

    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
    var result = confirm('user already existing');
</script>";
    } else {
        $insert = "INSERT INTO users(username,email,password,location,phone,user_type) VALUES('$name','$email','$password','$location','$phone','$type')";
        $endresult = mysqli_query($conn, $insert);

        if ($endresult) {
            $success[] = "Account created successfully";
        } else {


            $error[] = "account creation failed";
        }
    }
}
?>
