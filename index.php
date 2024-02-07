<!DOCTYPE html>
<html lang="en">
<?php
session_start();





ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');


require_once('initialize.php');
require_once('setup/connections.php');
require_once("config.php")

?>
<?php
$logoquery = $conn->query("SELECT * FROM system_info");
while($rowlogo=mysqli_fetch_assoc($logoquery)){
        $logoicon=$rowlogo['avatar'];}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?php echo 'images/'.$logoicon?>" class="border border-success rounded-circle" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Landing Page</title>
    <style>
        body {
            background-image: url('images/bg_corn.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            color: white;
        }

        .carousel-container {
            width: 80%;
            max-width: 1000px;
            height: auto;
            overflow: hidden;
            margin: 16px auto; /* Center the carousel */
        }

        .carousel {
            width: 100%;
        }

        .carousel-control {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: auto;
            margin: auto;
            z-index: 1;
        }

        .carousel-control-prev,
        .carousel-control-next {
            font-size: 2rem;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .top-products-container {
            display: flex;
            justify-content: space-between;
            margin: 16px auto;
            position: relative; /* Add relative positioning */
            background-color: rgba(0, 0, 0, 0.5); /* Black semi-transparent background */
            border-radius: 10px;
            padding: 20px;
        }

        .top-product {
            width: 30%;
            text-align: center;
        }

        .top-product img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .mission-vision-container,
        .registered-farmers-container,
        .about-us-container {
            margin-top: 50px; /* Adjusted margin-top */
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            min-height: 200px;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar with Logo -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php"><img src="images/sslogo_final.png" width="30" height="30" class="d-inline-block align-top" alt="Your Logo">SilangSarap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="featuredproducts.php">Featured Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Body Content -->
    <div class="container mt-4 position-relative">
        <header class="text-center mb-4">
            <h1>Welcome to Silang Sarap</h1>
            <p>Lorem ipsum dolor.</p>
        </header>
        <?php
        
        $systemquery = $conn->query("SELECT * FROM system_info");
		while($rowsystem=mysqli_fetch_assoc($systemquery)){
                $mission=$rowsystem['mission'];
                $vision=$rowsystem['vision'];
                $aboutus=$rowsystem['abt_us'];}
        
        ?>
        <!-- Carousel Container -->
        <div class="carousel-container">
            <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/bg_ganda.jpg" alt="First slide">
                    </div>
                     <?php
                            
                            $bannersquery = $conn->query("SELECT * FROM banners");
		                    while($rowbanner=mysqli_fetch_assoc($bannersquery)){
                                    $banner=$rowbanner['banner'];

                            
		                    ?>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo 'banners/'.$banner?>" alt="Second slide">
                    </div>
                    <?php }?>
                </div>
                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- Top Products Container -->
        <div class="top-products-container">
            <div class="top-product">
                <img src="sampleimage.jpg" alt="Top Product 1">
                <h3>Product 1</h3>
                <p>Description of Product 1.</p>
            </div>
            <div class="top-product">
                <img src="sampleimage.jpg" alt="Top Product 2">
                <h3>Product 2</h3>
                <p>Description of Product 2.</p>
            </div>
            <div class="top-product">
                <img src="sampleimage.jpg" alt="Top Product 3">
                <h3>Product 3</h3>
                <p>Description of Product 3.</p>
            </div>
        </div>

        <!-- Mission and Vision Container -->
        <div class="container mt-4 mission-vision-container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Mission</h2>
                    <p><?php echo $mission?></p>
                </div>
                <div class="col-md-6">
                    <h2>Vision</h2>
                    <p><?php echo $vision?></p>
                </div>
            </div>
        </div>

        <!-- Currently Registered Farmers Container -->
        <?php
                    $status=1;
                    $farmers = $conn->query("SELECT * FROM `clients` WHERE status='$status'")->num_rows;
                    
                  ?>
        <div class="container mt-4 registered-farmers-container">
            <h2>Currently Registered Farmers</h2>
            <p><?php echo number_format($farmers);?></p>
        </div>

        <!-- About Us Container -->
        <div class="container mt-4 about-us-container mb-5">
            <h2>About Us</h2>
            <p><?php echo $aboutus?></p>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>

