<?php
@include('connection/connect.php');
@include('components/navbar.php');
@include('tailwindcss.php');
$useremail = $_SESSION['email'];

$select = "SELECT * FROM testorder WHERE buyer = '$useremail' && bought = 1";
$result = mysqli_query($conn, $select);
// $row = mysqli_fetch_array($result);

$selectuser = "SELECT * FROM users WHERE email = '$useremail'";
$resultuser = mysqli_query($conn, $selectuser);
$rowuser = mysqli_fetch_array($resultuser);

$total = 0; // Initialize total variable
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<script>
    function alert() {
        var result = confirm("Do you really want to delete product from cart?");
        if (result) {
            alert("You clicked OK!")
        } else {
            alert("You clicked Cancel!")
        }
    }
</script>

<body style="">
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $itemid = $row["artid"];
                                $selectproduct = "SELECT * FROM art WHERE artid = '$itemid'";
                                $resultproduct = mysqli_query($conn, $selectproduct);
                                $rowproduct = mysqli_fetch_array($resultproduct);

                                // Add to total if item not bought
                                if ($row['bought'] == 1) {
                                    $total += $rowproduct['price'];
                                }
                            ?>

                                <tr>
                                    <td class="p-4">
                                        <div class="media align-items-center">
                                            <img src="uploads/<?= $rowproduct['image'] ?>" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                            <div class="media-body">
                                                <a href="#" class="d-block text-dark nav-link"><?php echo $rowproduct['name'] ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4">KES.<?php echo $rowproduct['price'] ?></td>
                                    <td class="text-right font-weight-semibold align-middle p-4">KES.<?php echo $rowproduct['price'] ?></td>

                                    <?php
                                    if ($row['bought'] == 0) {
                                        echo '
                                        <td class="text-center align-middle px-0"><a href="deleteproduct.php?artid=' . $rowproduct['artid'] . '" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>';
                                    } else {
                                        echo '<td class="text-center align-middle px-0"><p>Received</p></td>';
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Display total price and checkout button -->
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="text-right mt-4">
                        <label class="text-muted font-weight-normal m-0">Total Price</label>
                        <div class="text-large"><strong>KES.<?php echo $total ?></strong></div>
                    </div>
                    <div class="mt-4">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
    body {
        margin-top: 20px;
        background: #eee;
    }

    .ui-w-40 {
        width: 40px !important;
        height: auto;
    }

    .card {
        box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
    }

    .ui-product-color {
        display: inline-block;
        overflow: hidden;
        margin: .144em;
        width: .875rem;
        height: .875rem;
        border-radius: 10rem;
        -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
        vertical-align: middle;
    }
</style>

</html>
