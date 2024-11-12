<?php
session_start();
@include('components/navbar.php');
@include('tailwindcss.php');
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
        <div class="container md:px-5 p-3">
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
   




    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->



<!-- ✅ Grid Section - Starts Here 👇 -->
<section id="Projects"
    class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">
    <?php while($row = mysqli_fetch_array($collected)){?>
    <!--   ✅ Product card 1 - Starts Here 👇 -->
    <div class="md:w-72 w-full bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="viewproduct.php?id=<?php echo $row['id']?>">
            <img className="w-full object-fit" src="uploads/<?=$row['image'] ?>"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-4 py-3 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize"><?php echo $row['name']?></p>
                <div class="flex items-center">
                    <p class="text-lg font-semibold text-black cursor-auto my-3">Kes.<?php echo $row['price']?></p>
                    <del>
                        <p class="text-sm text-gray-600 cursor-auto ml-2">$<?php echo $row['price']?></p>
                    </del>
                    <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                        </svg></div>
                </div>
            </div>
        </a>
    </div>
    <?php
        }
        ?>
    <!--   🛑 Product card 1 - Ends Here  -->

    <!--   ✅ Product card 2 - Starts Here 👇 -->
    
    

</section>

<!-- 🛑 Grid Section - Ends Here -->


<!-- credit -->


<!-- Support Me 🙏🥰 -->
<script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>
<script>
    kofiWidgetOverlay.draw('mohamedghulam', {
            'type': 'floating-chat',
            'floating-chat.donateButton.text': 'Support me',
            'floating-chat.donateButton.background-color': '#323842',
            'floating-chat.donateButton.text-color': '#fff'
        });
</script>
</body>

</html>