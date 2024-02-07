<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(isset($_SESSION)){
$adminuser=$_SESSION['username'];
if(empty($adminuser)){

header('location: ../index.php');

}
}else{
header('location: ../index.php');
}

ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');


require_once('../../initialize.php');
require_once('../../setup/connections.php');
require_once("../../config.php")

?>
<?php
$confirmpasserror=$oldpasserror="";   
    if(isset($_POST['submit'])){
        
        $qryadmin = $conn->query("SELECT * FROM admin");
		while($adminrow=mysqli_fetch_assoc($qryadmin)){
            $id=$adminrow['id'];
            $name=$adminrow['username'];
            $password=$adminrow['password'];}

        $admin = $_POST['username'];
        $changepass = $_POST['changepass'];
        $confirmpass = $_POST['confirmpass'];
        $oldpass = $_POST['oldpass'];
        
    

     





        if(!empty($changepass)&& !empty($confirmpass) && !empty($oldpass)){
                if($oldpass!=$password){
                    $oldpasserror="Cannot recognize old password!";
                 
                }else{
                    if($changepass!=$confirmpass){
                     $confirmpasserror="Password don't match!";
                     

                    }else{
                        $newpass = $confirmpass;
                        if($admin && $newpass){
                           $date_added= date("Ymd");

                            $insertquery = mysqli_query($conn,"UPDATE admin SET username = '$admin', password = '$newpass' WHERE id = '$id';");
                            redirect('Admin/settings/accsett.php');
              
                          }else{

               
                          }
                    }
                }
        }else{
            $newpass= $password;
        }

        
           
    }
    
    
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
    <link rel="icon" type="image/png" href="<?php echo '../../images/'.$logoicon?>" class="border border-success rounded-circle" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Make the carousel edge-to-edge and horizontal */
        .carousel {
            width: 100%;
        }

        /* Set padding to 0 for the carousel inner container */
        .carousel-inner {
            margin: 0;
            padding: 0;
        }

        /* Customize your styles as needed */
        .navbar {
            background-color: #ffffff;
        }

        /* Reduce the height of the carousel images */
        .carousel-item img {
            height: 250px; /* Adjust the height as needed */
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
                    <img src="<?php echo '../../images/'.$logoicon?>" alt="Logo" width="80" height="80" class="d-inline-block align-top border border-success rounded-circle">
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
                            <a class="nav-link" style="color:#0A5C36;" href="../homepage.php">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color:#0A5C36;">
                                User Management
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../users/farmers.php">Farmer</a></li>
                                <li><a class="dropdown-item" href="../users/users.php">Client</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color:#0A5C36;">
                                Product Management
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../products/category.php">Category</a></li>
                                <li><a class="dropdown-item" href="../products/type.php">Type</a></li>
                            </ul>
                        </li>

                        <!-- My Account Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color:#0A5C36;">
                                Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="systemsett.php">System</a></li>
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
		    <h3 class="card-title">My Account</h3>
	</div>
	<div class="card-body">
		<form method="post">
        <?php 
$i = 1;
	$qry = $conn->query("SELECT * FROM admin");
		while($row=mysqli_fetch_assoc($qry)){
                $id=$row['id'];
                $name=$row['username'];
                $password=$row['password'];}
?>
  <div class="form-group" encenctype="multipart/form-data">
    <label for="username">username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="username" value="<?=$name?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Change Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="changepass" value="">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="confirmpass" value="">
      <span><?=$confirmpasserror?></span>
     <div class="form-group">
    <label for="exampleInputPassword1">Old Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="oldpass" value="">
      <span><?=$oldpasserror?></span>

  </div>
  </div>
  <br>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
	</div>
</div>
        </div>

    </div>

    <!-- Bootstrap JS (Optional, for dropdowns and other features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
