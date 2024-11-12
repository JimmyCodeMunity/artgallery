<?php
session_start();
@include('components/navbar.php');
@include('connection/connect.php');
if($_SESSION['logged_in'] !== true){
    header('location:login.php');
    
}

error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$user = $_SESSION['username'];
$useremail = $_SESSION['email'];

$select = "SELECT * FROM users WHERE email = '$useremail'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_array($result);








$selectart = "SELECT * FROM art";
$collected = mysqli_query($conn,$selectart);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <aside class="text-center bg-gradient-primary-to-secondary">
        <div class="container px-5 p-3">
            <div class="row gx-5 justify-content-center">
                <div class="col-xl-8">
                    <div class="h2 fs-1 text-white mb-4">"Welcome back <?php echo
                                                                        $user
                                                                        ?>"</div>
                    <form action="">
                        <div class="text-center d-flex">

                            <input type="text" class="form-control mx-2" placeholder="search art name">
                            <button class="btn btn-primary">Search</button>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </aside>
    <div class="container mx-auto" style="display:grid;place-items:left;">
        <div class="row my-5">

        <?php while($row = mysqli_fetch_array($collected)){?>
            <div class="col-lg-4 my-3">
                <div class="card">
                    <div class="card-img">
                        <img class="card-img-top" style="max-height:12rem;height:13rem;" src="uploads/<?=$row['image'] ?>" alt="">
                    </div>
                    <div class="card-info">
                        <p class="text-title"><?php echo $row['name']?> </p>
                        <p class="text-body"><?php echo $row['description']?></p>
                    </div>
                    <div class="card-footer">
                        <span class="text-title">Ksh.<?php echo $row['price']?></span>
                        <?php
                        echo '<a href="viewproduct.php?id='.$row['id'].'" class="card-button">
                            <svg class="svg-icon" viewBox="0 0 20 20">
                                <path d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                                <path d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                                <path d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                            </svg>
                        </a>';
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
            
            
            
        </div>
    </div>
</body>

</html>