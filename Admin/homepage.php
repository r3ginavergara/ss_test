<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(isset($_SESSION)){
$adminuser=$_SESSION['username'];
if(empty($adminuser)){

header('location: index.php');

}
}else{
header('location: index.php');
}




ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');


require_once('../initialize.php');
require_once('../setup/connections.php');
require_once("../config.php")

?>

<?php
$logoquery = $conn->query("SELECT * FROM system_info");
while($rowlogo=mysqli_fetch_assoc($logoquery)){
        $logoicon=$rowlogo['avatar'];}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Silang Sarap</title>
    <link rel="icon" type="image/png" href="<?php echo '../images/'.$logoicon?>" class="border border-success rounded-circle" />
    <!-- Bootstrap CSS -->


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Make the carousel edge-to-edge and horizontal */
        .carousel {
            width: 95%;
            margin-left:auto;
            margin-right:auto;
            margin-top: 2%;
        }

        /* Set padding to 0 for the carousel inner container */
        .carousel-inner {

        }
        /* Reduce the height of the carousel images */
        .carousel-item img {
            height: 450px; /* Adjust the height as needed */
            object-fit: cover;
        }

        /* Adjust the size of the product images in inches */
        .product-image {
            width: 2in;
            height: 2in;
            object-fit: cover;
            margin: 0.5in; /* Space around images */
        }

        /* Search Bar Style */
        .search-bar {
            margin-top: 10px;
        }

        /* Center the categories */
        .category-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Center each category item */
        .list-group-item {
            text-align: center;
        }

        /* Adjust margin for categories on small screens */
        @media (max-width: 576px) {
            .category-container {
                margin-top: 10px;
            }

            .list-group-item {
                margin-bottom: 5px;
            }
        }

        /* Adjust margin for products on small screens */
        @media (max-width: 768px) {
            .product-image {
                margin: 0.2in;
            }
        }
        .outline{
            border: 1px solid;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand ms-auto" href="#">
                    <img src="<?php echo '../images/'.$logoicon?>" alt="Logo" width="80" height="80" class="d-inline-block align-top border border-success rounded-circle">
                </a>

                <!-- Navbar Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" style="color:#0A5C36;" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color:#0A5C36;">
                                User Management
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="users/farmers.php">Farmer</a></li>
                                <li><a class="dropdown-item" href="users/users.php">Client</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color:#0A5C36;">
                                Product Management
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="products/category.php">Category</a></li>
                                <li><a class="dropdown-item" href="products/type.php">Type</a></li>
                            </ul>
                        </li>

                        <!-- My Account Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color:#0A5C36;">
                                Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="settings/systemsett.php">System</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <!-- Search Bar -->
        <div class="container search-bar">
            <div class="row justify-content-end">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row mt-4">
           <div class="card card-outline card-primary">
	        <div class="card-header">
		        <h1 class="card-title">Welcome to Silang Sarap <?echo $adminuser ?>!</h1>
	       </div>
	       <div class="card-body">
		            <div class="col-12 col-sm-6 col-md-3">
                         <div class="info-box">
                            <span class="info-box-icon bg-white elevation-1"><i class="fas fa-table"></i></span>

                         <div class="info-box-content">
                             <span class="info-box-text">Total Stocks</span>
                              <span class="info-box-number">
                                  <?php
                                    $inv = $conn->query("SELECT sum(quantity) as total FROM inventory ")->fetch_assoc()['total'];
                                    $sales = $conn->query("SELECT sum(quantity) as total FROM order_list where order_id in (SELECT order_id FROM sales) ")->fetch_assoc()['total'];
                                    echo number_format($inv - $sales);
                                  ?>
                               
                              </span>
                          </div>
                      <!-- /.info-box-content -->
                         </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                         <div class="info-box">
                            <span class="info-box-icon bg-white elevation-1"><i class="fas fa-table"></i></span>

                         <div class="info-box-content">
                             <span class="info-box-text">Total Stocks</span>
                              <span class="info-box-number">
                                  <?php
                                    $inv = $conn->query("SELECT sum(quantity) as total FROM inventory ")->fetch_assoc()['total'];
                                    $sales = $conn->query("SELECT sum(quantity) as total FROM order_list where order_id in (SELECT order_id FROM sales) ")->fetch_assoc()['total'];
                                    echo number_format($inv - $sales);
                                  ?>
                               
                              </span>
                          </div>
                      <!-- /.info-box-content -->
                         </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                         <div class="info-box">
                            <span class="info-box-icon bg-white elevation-1"><i class="fas fa-table"></i></span>

                         <div class="info-box-content">
                             <span class="info-box-text">Total Stocks</span>
                              <span class="info-box-number">
                                  <?php
                                    $inv = $conn->query("SELECT sum(quantity) as total FROM inventory ")->fetch_assoc()['total'];
                                    $sales = $conn->query("SELECT sum(quantity) as total FROM order_list where order_id in (SELECT order_id FROM sales) ")->fetch_assoc()['total'];
                                    echo number_format($inv - $sales);
                                  ?>
                               
                              </span>
                          </div>
                      <!-- /.info-box-content -->
                         </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                         <div class="info-box">
                            <span class="info-box-icon bg-white elevation-1"><i class="fas fa-table"></i></span>

                         <div class="info-box-content">
                             <span class="info-box-text">Total Stocks</span>
                              <span class="info-box-number">
                                  <?php
                                    $inv = $conn->query("SELECT sum(quantity) as total FROM inventory ")->fetch_assoc()['total'];
                                    $sales = $conn->query("SELECT sum(quantity) as total FROM order_list where order_id in (SELECT order_id FROM sales) ")->fetch_assoc()['total'];
                                    echo number_format($inv - $sales);
                                  ?>
                               
                              </span>
                          </div>
                      <!-- /.info-box-content -->
                         </div>
                        <!-- /.info-box -->
                    </div>
                   
 
		   </div>
            
	     </div>
         <div id="imageCarousel" class="carousel slide m" data-bs-ride="carousel">




                            <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../images/bg_ganda.jpg" class="d-block w-100" alt="Image 1">
                            </div>
                            <?php
                            $bannersquery = $conn->query("SELECT * FROM banners");
		                    while($rowbanner=mysqli_fetch_assoc($bannersquery)){
                                    $banner=$rowbanner['banner'];
		                    ?>
                            <div class="carousel-item">
                                <img src="<?php echo '../banners/'.$banner?>" class="d-block w-100" >
                            </div>
                            <?php }?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
     </div>
    <!-- Bootstrap JS (Optional, for dropdowns and other features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
