<?php
@include('tailwindcss.php');
@include('connection/connect.php');


function generateUniqueID($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Generate a random string of specified length
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

// Usage example
$uniqueID = generateUniqueID();

if (isset($_POST['create_account'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $type = $_POST['user_type'];
    $otp = rand(10000, 999999);

    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists';
    } else {
        $insert = "INSERT INTO users(username,email,password,location,phone,user_type,userid,otp) VALUES('$name','$email','$password','$location','$phone','$type','$uniqueID','$otp')";
        $inserted = mysqli_query($conn, $insert);
        if ($inserted) {
            echo '<script>alert("Registration Successful")</script>';
            require('mail/send.php');
            sendVerificationEmail($email, $otp, $username);
            // header('location: login.php');
        } else {
            $error[] = 'Failed to create an account';
        }
    }
}



?>
<div class="w-full justify-center items-center h-screen">
    <div class="w-full h-full flex md:flex-row flex-col justify-evenly items-center sm:px-16 px-6">
        <div class="md:w-[50%] w-full">
            <img src="assets/reg.png" alt="">
        </div>
        <div class="md:w-[50%] w-full">
            <form action="" method="post">
                <h1 class="text-3xl font-semibold tracking-wide">Welcome to Art Gallery</h1>
                <p class="text-slate-400">Create your account!</p>
                <div class="py-4 space-y-3">
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-slate-600">Username</label>
                        <input type="text" name="username" placeholder="enter username" class="px-4 py-2 rounded-lg border border-slate-300 border-1">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-slate-600">Phone</label>
                        <input type="number" name="phone" placeholder="enter phone" class="px-4 py-2 rounded-lg border border-slate-300 border-1">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-slate-600">Email</label>
                        <input type="email" name="email" placeholder="enter email" class="px-4 py-2 rounded-lg border border-slate-300 border-1">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-slate-600">Address</label>
                        <input type="text" name="location" placeholder="enter address" class="px-4 py-2 rounded-lg border border-slate-300 border-1">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_type" id="" class="form-control" required>
                            <option value="" class="form-control">Select account type</option>
                            <option class="form-control" value="buyer">Buyer</option>
                            <option class="form-control" value="seller">Seller</option>
                        </select>
                        <!-- <label for="phone">Account Type</label> -->
                        
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-slate-600">Password</label>
                        <input type="password" name="password" placeholder="enter password" class="px-4 py-2 rounded-lg border border-slate-300 border-1">
                    </div>
                    <div>
                        <button name="create_account" class="bg-purple-600 h-10 w-full md:w-40 rounded-lg text-white mt-3">SignUp</button>
                    </div>

                </div>
                <div>
                    <a href="login.php" class="text-slate-500">
                        Alreadt have an account?
                        <span class="text-purple-600">Sign In</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>