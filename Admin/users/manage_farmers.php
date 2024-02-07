<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$request_id=$_GET['id'];
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

?>
<?php
#update query
if(isset($_POST['edit'])){
    $update_id= $_POST['id'];
    $status = $_POST['status'];
    $updatequery = "UPDATE users SET status='$status' WHERE id='$update_id'";
    $updateconfirm = mysqli_query($conn,$updatequery);
    redirect('Admin/users/farmers.php');






}


#delete query
 if(isset($_POST['delete'])){

     $delete_id = $_POST['id'];


     $deletequery="DELETE FROM users where id='$delete_id'";
     $deleteconfirm = mysqli_query($conn,$deletequery);
     redirect('Admin/users/farmers.php');



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
        a{
            text-decoration:none;
            color: black;
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
                                <li><a class="dropdown-item" href="../settings/systemsett.php">System</a></li>
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>





        <!-- Main Content -->
        <div class="row mt-4">
        <div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"></h3>
	</div>
	<div class="card-body ">
		<div class="container-fluid">
        <div class="container-fluid">
			<div>
		<a class="btn btn-outline-primary" href="farmers.php" <span class="fa fa-trash text-danger"></span> Go back</a>
                   
                    </div>
                        <div class="modal-body border p-5 mx-auto  w-50">
                        <?php
                        	$qry = $conn->query("SELECT * FROM users WHERE id = '$request_id'");
							while($row=mysqli_fetch_assoc($qry)){
                                  $id=$row['id'];
                                  $avatar=$row['avatar'];
                                  $name=$row['firstname']. " " .$row['lastname'];
   
                                  }
					       ?>
                            <form method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?=$id?>" name="id">
                                <center> <img src="<?php echo '../../images/'.$avatar?>"  width="260px" height="260px" target="_self"><br>
                                <h4></h4>
                                <h3><?php echo $name?></h3>
                                </center><hr>

                                <select name="status" class="form-control" id="status" required>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select><br>
                                <center> 
                                <input type="submit" name="edit" class="btn btn-outline-success btn-block" value="Update">
                                
                                <button type="button" class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#delete">Delete</button>

                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		</div>
	</div>
</div>
        </div>

    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>

    <!-- Registration Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h5 class="mx-auto" style="color:red;" id="registrationModalLabel">Delete Account</h5></center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your registration form fields here -->
                    <form method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$id?>" name="id">
                    <?php
                   $req = $_GET['id'];
                   $qrys = $conn->query("SELECT * FROM users WHERE id = '$req'");
							while($rows=mysqli_fetch_assoc($qrys)){
                                  $ids=$rows['id'];
                                  $avatars=$rows['avatar'];
                                  $names=$rows['firstname']. " " .$rows['lastname'];
   
                                  }
                    
                    
                    ?>
                        <!-- Delete Confirmation form fields go here -->
                        <div class="form-group">

                        <h3>Are you sure you want to delete <?php echo $names?> ?</h3><br>
                        <center>
                        
                        <input type="submit" name="delete" class="btn btn-danger btn-block" value="Delete">
		                <a class="btn btn-outline-primary" href="manage_farmers.php?id=<?=$ids;?>"<span class="fa fa-trash text-danger"></span> Go back</a>
                        </center>
                    </form>
                </div>
            </div>
        </div>       
    </div>