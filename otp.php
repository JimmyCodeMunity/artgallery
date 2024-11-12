<?php
session_start();
@include('tailwindcss.php');
@include('connection/connect.php');
$uid = $_GET['uid'];

$select = "SELECT * FROM users WHERE email = '$uid'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_array($result);
$username =  $row['username'];
$email =  $row['email'];
$user_type = $row['user_type'];
echo $user_type;

// echo $row['email'];

if (isset($_POST['verify'])) {
    $otp = $_POST['otp'];
    if ($otp == $row['otp']) {
        $update = "UPDATE users SET verified = 1 WHERE email = '$uid'";
        $updated = mysqli_query($conn, $update);
        if ($updated) {
            $selectuser = "SELECT * FROM users WHERE email = '$uid'";
            $resultuser = mysqli_query($conn, $selectuser);
            $rowuser = mysqli_fetch_array($resultuser);
            
            if ($rowuser['user_type'] === "buyer") {
                echo "user is buyer".$rowuser['user_type'];
                // $error[] = 'buyer account';
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['logged_in'] = true;
                // $success[] = 'user logged in successfully';
                header('location:user.php');
            } else if ($rowuser['user_type'] === "seller") {
                echo "user is seller".$rowuser['user_type'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['logged_in'] = true;
                $success[] = 'seller logged in successfully';
                header('location:sellerdash/index.php');
            }
            // $_SESSION['username'] = $row['username'];
            // $_SESSION['email'] = $row['email'];
            // $_SESSION['logged_in'] = true;

            // header("Location:index.php");
        } else {

            $error[] = 'Failed to verify.Check otp and try again.';
        }
    } else {

        $error[] = 'Incorrect OTP. Try again.';
    }
}

// resend
if (isset($_POST['resend'])) {
    $otp = rand(10000, 99999);
    $update = "UPDATE users SET otp = '$otp' WHERE email = '$uid'";
    $updated = mysqli_query($conn, $update);

    if ($updated) {
        require('mail/resend.php');
        sendVerificationEmail($email, $otp, $username);
        // alert if sent successfull
        $success[] = 'New verification code sent successfully';
        // header('location: verify.php?uid='.$email);
    }
}
?>
<div class="w-full flex h-screen justify-center items-center">
    <div class="flex flex-col justify-center items-center space-y-4">
        <form action="" class="flex flex-col items-center space-y-2" method="post">
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<p class="text-red-500">' . $error . '</p>';
                }
            }
            ?>
            <?php
            if (isset($success)) {
                foreach ($success as $success) {
                    echo '<p class="text-green-500">' . $success . '</p>';
                }
            }
            ?>
            <img src="assets/otp.png" alt="">
            <div class="flex flex-col space-y-2 justify-center items-center">
                <label for="" class="text-slate-600">Enter OTP</label>
                <input type="number" name="otp" placeholder="enter otp" class="px-4 py-2 rounded-lg border border-slate-300 border-1">
            </div>
            <div>
                <button type="submit" name="verify" class="bg-purple-600 h-10 w-40 rounded-lg text-white">Verify</button>
            </div>
            <div>
                <button type="submit" name="resend" class="bg-purple-500 h-10 w-40 rounded-lg text-white">Resend</button>
            </div>
        </form>

    </div>
</div>