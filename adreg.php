<?php
@include('connection/connect.php');
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $select = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'User already exists';

    }else{
        $insert = "INSERT INTO admin(username,email,password)VALUES('$username','$email','$password')";
        $endresult = mysqli_query($conn, $insert);

        if($endresult){
            header('location: admin.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminRegister</title>
</head>

<body>

    <form class="form" action="" method="post">
        <p class="form-title">Sign Up to your Admin account</p>
        <div class="input-container">
            <input placeholder="Enter Username" name="username" type="text">
            <span>
                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg>
            </span>
        </div>
        <div class="input-container">
            <input placeholder="Enter email" name="email" type="email">
            <span>
                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg>
            </span>
        </div>
        <div class="input-container">
            <input placeholder="Enter password" name="password" type="password">

            <span>
                <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg>
            </span>
        </div>
        <button class="submit" name="register" type="submit">
            Sign Up
        </button>

        <p class="signup-link">
            Already have account?
            <a href="admin.php">Sign in</a>
        </p>
    </form>


</body>
<style>
    body{
        height:100vh;
        width:100vw;
        display:grid;
        place-items: center;
    }
    .form {
        background-color: #fff;
        display: block;
        padding: 1rem;
        max-width: 350px;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .form-title {
        font-size: 1.25rem;
        line-height: 1.75rem;
        font-weight: 600;
        text-align: center;
        color: #000;
    }

    .input-container {
        position: relative;
    }

    .input-container input,
    .form button {
        outline: none;
        border: 1px solid #e5e7eb;
        margin: 8px 0;
    }

    .input-container input {
        background-color: #fff;
        padding: 1rem;
        padding-right: 3rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        width: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .input-container span {
        display: grid;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        padding-left: 1rem;
        padding-right: 1rem;
        place-content: center;
    }

    .input-container span svg {
        color: #9CA3AF;
        width: 1rem;
        height: 1rem;
    }

    .submit {
        display: block;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        background-color: #4F46E5;
        color: #ffffff;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        width: 100%;
        border-radius: 0.5rem;
        text-transform: uppercase;
    }

    .signup-link {
        color: #6B7280;
        font-size: 0.875rem;
        line-height: 1.25rem;
        text-align: center;
    }

    .signup-link a {
        text-decoration: underline;
    }
</style>

</html>