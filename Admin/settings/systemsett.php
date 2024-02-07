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

 if(isset($_POST['submit'])){

        $updateid=$_POST['id'];

        $systemname = $_POST['systemname'];
        $mission = $_POST['mission'];
        $vision = $_POST['vision'];
        $aboutus = $_POST['aboutus'];
        
        if($systemname && $mission && $vision && $aboutus){

         $updatequery = mysqli_query($conn,"UPDATE system_info set name='$systemname',mission='$mission',vision='$vision',abt_us='$aboutus' WHERE id='$updateid'");      
         redirect('Admin/settings/systemsett.php');
}   

 }  


if(isset($_POST['changelogo'])){

        $updateid=$_POST['id'];

            //Start of File upload
        $image = '';
        $directory = '../../images/';
        $file = uniqid();
        $img_name = explode('.', $_FILES['image']['name']);
        $ext = strtolower(end($img_name));

        $extensions = ['jpeg', 'jpg', 'png'];
        $errors = [];
        
        if(in_array( $ext, $extensions ) === false) {
            $errors[] = 'Invalid image extension!';
        }
        $tmp_name = $_FILES['image']['tmp_name'];
        $image = $file.'.'.$ext;

        $isFileUploaded = move_uploaded_file($tmp_name, $directory.$image );
        //End of File Upload


        if($image){

         $updatequery = mysqli_query($conn,"UPDATE system_info set avatar='$image' WHERE id='$updateid'");      
        
}
}
        
if(isset($_POST['banners'])){



         //Start of File upload
        $image = '';
        $directory = '../../banners/';
        $file = uniqid();
        $img_name = explode('.', $_FILES['image']['name']);
        $ext = strtolower(end($img_name));

        $extensions = ['jpeg', 'jpg', 'png'];
        $errors = [];
        
        if(in_array( $ext, $extensions ) === false) {
            $errors[] = 'Invalid image extension!';
        }
        $tmp_name = $_FILES['image']['tmp_name'];
        $image = $file.'.'.$ext;

        $isFileUploaded = move_uploaded_file($tmp_name, $directory.$image );
        //End of File Upload


        if($image){
         $insertbanner = mysqli_query($conn,"INSERT INTO banners(banner) VALUES('$image')");    
         redirect('Admin/settings/systemsett.php');  }

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
    <link rel="icon" type="image/png" href="<?php echo '../../images/'.$logoicon?>" class="border border-success rounded-circle" />
</head>
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
		    <h3 class="card-title">System Settings</h3>
	</div>
<div class="card-body">

<?php



$qrysys = $conn->query("SELECT * FROM system_info");
    while($rowsys=mysqli_fetch_assoc($qrysys)){
        $idsys=$rowsys['id'];
        $namesys=$rowsys['name'];
        $avatarsys=$rowsys['avatar'];
        $missionsys=$rowsys['mission'];
        $visionsys=$rowsys['vision'];
        $aboutussys=$rowsys['abt_us'];

        }

?>



  <form method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?=$idsys?>">
        <!-- Logo-->

  <div class="form-group">
  <label for="logo">System Logo</label>
    <center> <img src="<?php echo '../../images/'.$avatarsys?>"  width="260px" height="260px" target="_self" class="border border-success rounded-circle m-2"></center><hr>
    <input type="file" accept=".jpg, .png, .jpeg" class="form-control" id="Avatar" name="image"><br>
    <button type="submit" name="changelogo" class="btn btn-primary">Change Logo</button><br><br>
  </div>


        <!-- system-->



  <div class="form-group">
    <label for="systemname">System Name</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="systemname" value="<?=$namesys?>">
  </div>
   <div class="form-group">
    <label for="mission">Mission</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="mission" value="<?=$missionsys?>" >
  </div> <div class="form-group">
    <label for="vision">Vision</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="vision" value="<?=$visionsys?>" >
  </div>
   <div class="form-group">
    <label for="aboutus">About us</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="aboutus" value="<?=$aboutussys?>"><br>
    <button type="submit" name="submit" class="btn btn-primary">Edit</button>
  </div><br><br>
</form>

<form method="post" enctype="multipart/form-data">
        <!-- Add banners-->
  <div class="form-group">
  <label for="logo">Add Banners</label>
    <input type="file" accept=".jpg, .png, .jpeg" class="form-control" id="Avatar" name="image"><br>
    <button type="submit" name="banners" class="btn btn-primary">Add Banners</button><br><br>


    <div class="d-flex justify-content-center mb-4">
        <div class="container">
            <div class="row">
            <?php
                    $bannersquery = $conn->query("SELECT * FROM banners");
                    while($rowbanner=mysqli_fetch_assoc($bannersquery)){
                            $bannerid = $rowbanner['id'];
                            $banner=$rowbanner['banner'];
                    ?>

          <div class="col-lg-4"> 
          <a href="deletebanner.php?id=<?=$bannerid?>" target="_self" class="btn btn-outline-danger" >X</a>
            <div class="card">
              <img
                src="<?php echo '../../banners/'.$banner?>"
                class="card-img-top"
                alt="Banner"
              />        
            </div>

          </div>
            <?php }?>  
<div>


  </div>
</form>

	</div>
</div>
        </div>

    </div>

    <!-- Bootstrap JS (Optional, for dropdowns and other features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>