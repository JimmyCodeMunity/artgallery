<?php
session_start();
@include('components/navbar.php');
@include('connection/connect.php');
@include('tailwindcss.php');

$id = $_GET['id'];

$select = "SELECT * FROM art WHERE id = '$id'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_array($result);


$phoneNumber = $row['phone']; // Replace this with the actual phone number

// Function to sanitize phone number
function sanitizePhoneNumber($phoneNumber)
{
    // Remove any non-numeric characters from the phone number
    return preg_replace('/[^0-9]/', '', $phoneNumber);
}

// Sanitize the phone number
$sanitizedPhoneNumber = sanitizePhoneNumber($phoneNumber);

if (!$_SESSION['logged_in']) {
    echo "<script>
            var result = confirm('Login to view shop');
            if (result) {
                window.location.href = 'index.php'; // Redirect to the login page
            } else {
                // Stay on the same page or perform other actions
            }
        </script>";
    header('location: index.php');
}

$artid = $row['artid'];
$sellerid = $row['sellerid'];
$useremail = $_SESSION['email'];

if(isset($_POST['cart'])){
    $available = "SELECT * FROM testorder WHERE buyer = '$useremail' && artid = '$artid' && bought = 0";
    $collectall = mysqli_query($conn,$available);


    if(mysqli_num_rows($collectall) > 0){
        $error[] = 'Item already ordered';
        $alreadyincart = true;
        echo "<script>
            alert('product already ordered.');
            </script>";
    }else{
        $insert = "INSERT INTO testorder (artid,sellerid,buyer)VALUES('$artid','$sellerid','$useremail')";
        $added = mysqli_query($conn, $insert);
        if($added){
            $success[] = 'Product successfully added to cart';

            // echo "<script>
            // alert('product succeffuly added to orders.');
            // window.location.href='cart.php';
            // </script>";
        }
        // header('location: cart.php');
    }
    
}







?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<script>
    function redirectToWhatsApp() {
        // Get the sanitized phone number from PHP
        var phoneNumber = "<?php echo $sanitizedPhoneNumber; ?>";
        // Redirect to WhatsApp
        // window.location.href = 'whatsapp://send?phone=' + phoneNumber;
        window.open('https://web.whatsapp.com/send?phone=' + phoneNumber);
        window.open('tel:' + phoneNumber);
    }
</script>

<body>
    <header>
        <!-- Jumbotron -->

        <!-- Jumbotron -->


        <!-- Heading -->
    </header>

    <!-- content -->
    <section class="py-5">
        <div class="container">
            <div class="row gx-5 mt-5 mt-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="uploads/<?= $row['image'] ?>" />
                        </a>
                    </div>

                    <!-- thumbs-wrap.// -->
                    <!-- gallery-wrap .end// -->
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            <?php echo $row['name'] ?>
                        </h4>
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
                        <div class="d-flex flex-row my-3">
                            <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">
                                    4.5
                                </span>
                            </div>

                        </div>

                        <div class="mb-3">
                            <span class="h5">Ksh.<?php echo $row['price'] ?></span>
                            <span class="text-muted">/per piece</span>
                        </div>

                        <p>
                            <?php echo $row['description'] ?>
                        </p>
                        <p>
                            serioal: <?php echo $row['artid'] ?>
                        </p>
                        <p>
                            user: <?php echo $useremail ?>
                        </p>



                        <hr />

                        <div class="row mb-4">
                            <!-- <div class="col-md-4 col-6">
                                <label class="mb-2"><?php echo $row['phone'] ?></label>
                                <select class="form-select border border-secondary" style="height: 35px;">
                                    <option>Small</option>
                                    <option>Medium</option>
                                    <option>Large</option>
                                </select>
                            </div> -->
                            <!-- col.// -->
                            <div class="col-md-4 col-6 mb-3">
                                <!-- <label class="mb-2 d-block">Quantity</label>
                                <div class="input-group mb-3" style="width: 170px;">
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" class="form-control text-center border border-secondary" placeholder="14" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                        <!-- <?php
                        echo '<a href="checkout1.php?id='.$row['id'].'" class="btn btn-warning shadow-0"> Buy now </a>';
                        
                        ?> -->
                        <a href="#" class="btn btn-primary shadow-0" onclick="redirectToWhatsApp()"> <i class="me-1 fa fa-shopping-basket"></i>Contact Seller </a>
                        <br>
                        <br>
                        <!-- <?php
                    if(isset($error)){
                      foreach($error as $error){
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                        };
      };
      ?> -->

                        
                        <form action="" method="post">
                            <?php
                            
                            ?>
                            <button type="submit" class='btn btn-primary shadow-0' name="cart"> <i class='me-1 fa fa-shopping-basket'></i>Order </button>
                        </form>
                    </div>

                </main>
            </div>
        </div>
    </section>
    <!-- content -->





</body>

</html>