<?php
session_start();
@include('components/navbar.php');
@include('connection/connect.php');
$emailsess = $_SESSION['email'];
// echo "session email".$emailsess;

$select = "SELECT * FROM users WHERE email = '$emailsess'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_array($result);

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

<body>
    <div class="container bootstrap snippets bootdey card mt-5">
        <h1 class="text-primary">Edit Profile</h1>
        <hr>
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="avatar img-circle img-thumbnail" alt="avatar">
                    <h6>Upload a different photo...</h6>

                    <input type="file" class="form-control">
                </div>

                <a href="./auth/logout.php" class="btn btn-primary my-5 rounded-pill px-3 mb-2 mb-lg-0">
                        <span class="d-flex align-items-center">
                            <i class="bi-amd me-2"></i>
                            <span class="small">Logout</span>
                        </span>
                    </a>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                
                <h3>Personal info</h3>

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">First name:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="<?php echo $_SESSION['username']?>" type="text" value="dey-dey">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Phone:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="<?php echo $row['phone']?>"" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Location:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="<?php echo $row['location']?>"" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="<?php echo $_SESSION['email']?>"  type="text" value="janesemail@gmail.com">
                        </div>
                    </div>
                    <div class="form-group my-5">
                        
                        <div class="col-lg-8">
                            <button class="btn btn-primary btn-lg">Update</button>
                        </div>
                    </div>

                    
                    
                </form>
            </div>
        </div>
    </div>
    <hr>
</body>
<style>
    body {
        margin-top: 150px;
    }
    .card{
        padding:40px;
    }

    .avatar {
        width: 200px;
        height: 200px;
    }
</style>

</html>