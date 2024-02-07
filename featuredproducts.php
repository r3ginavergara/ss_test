<!DOCTYPE html>
<?php
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');
session_start();

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
    <title>Login Page</title>
    <link rel="icon" type="image/png" href="<?php echo 'images/'.$logoicon?>" class="border border-success rounded-circle" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('images/bg_corn.jpg'); /* Replace 'background.jpg' with your background image file */
            background-size: cover; 
            height: 100%;
            margin: 0;
            align-items: center;
            justify-content: center;

        }

        .container{
            margin-top: 5%;
            

        }


        .product-container {
            display:inline-block;
            top: 15%; /* Adjusted top position */
            left: 30%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            padding: 20px; /* Adjusted padding */
            border-radius: 10px; /* Optional: Add rounded corners */
            color: white;
            width: 70%; /* Adjusted width */
            max-width: 700px; /* Set a maximum width if desired */
            
        }
        table,td,tr{
            vertical-align:top;
        }

    </style>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img src="images/sslogo_final.png" width="30" height="30" class="d-inline-block align-top" alt="Your Logo">SilangSarap</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
      </li>
    </ul>
  </div>
</nav>
</div>


        <div class="container mx-auto">
            <?php
                $typesquery = $conn->query("SELECT * FROM types");
                while($typeslogo=mysqli_fetch_assoc($typesquery)){
                $name=$typeslogo['name'];
                $typedescription=$typeslogo['description'];
                $typeimage=$typeslogo['image_path'];
        
            ?>
            <!-- Semi-transparent container with product image and details -->
            <div class="d-inline">
            <div class="product-container ">
                <table><tr><td>
                <img src="<?php echo 'images/'.$typeimage?>" alt="Product Image" width="100" height="100" class="m-1">
                </td><td>
                    <div class="product-details ml-1 w-1">
                        <h4><?php echo $name?></h4>
                        <p>Description: <?php echo $typedescription?></p>
                    </div>
                </td></tr></table>
            </div><br>
            </div>
             <?php }?>
            </div>


    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
