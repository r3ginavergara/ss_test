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
header('location: index.php');
}

ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');


require_once('../../initialize.php');
require_once('../../setup/connections.php');
require_once("../../config.php")

?>
<!-- Registration -->
<?php



    if(isset($_POST['create'])){


        $name =$_POST['category'];
        $description = $_POST['description'];
        $status = $_POST['status'];


        $checkcat = "SELECT * FROM categories WHERE category = '$name' and description = '$description'";
        $checkresult = mysqli_query($conn,$checkcat);
        $countcheck = mysqli_num_rows($checkresult);

            if($countcheck == 1){
                 redirect('Admin/products/category.php');
  
            }else {
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

        
                if($name && $description && $status && $image){
               $date_added= date("Ymd");

                $insertquery = mysqli_query($conn,"INSERT INTO categories(category,description,status,image,date_created) 
                VALUES ('$name','$description','$status','$image','$date_added')");
                #redirect('Admin/products/category.php');
           }
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
                                <li><a class="dropdown-item" href="category.php">Category</a></li>
                                <li><a class="dropdown-item" href="type.php">Type</a></li>
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
		<h3 class="card-title">List of Categories</h3>
		<div class="card-tools">
            <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#registrationModal">Create New</button>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-strip">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="5%">
					<col width="5%">

				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Category</th>
						<th>Descrption</th>
						<th>Date Created</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
						$qry = $conn->query("SELECT * FROM categories");
							while($row=mysqli_fetch_assoc($qry)){
                                  $id=$row['id'];
                                  $name=$row['category'];
                                  $description=$row['description'];
                                  $status=$row['status'];
                                  $date_created=$row['date_created'];

					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							
                            </td>
							<td><?php echo $name ?></td>
							<td ><p class="m-0 truncate"><?php echo $description ?></p></td>
							<td ><p class="m-0 truncate"><?php echo $date_created ?></p></td>
							<td>
                             <?php if($status == 1): ?>
                             <span class="badge bg-success p-2">Active</span>
                            <?php else: ?>
                                    <span class="badge bg-danger p-2">Inactive</span>
                             <?php endif; ?>
                            </td>
							<td >
							<a  href="manage_category.php?id=<?php echo $id ?>" type="button" class="btn btn-outline-success btn-block" >Edit</a>
							</td>
						</tr>
					    <?php } ?>
				</tbody>
			</table>
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

    <!-- Registration Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:#0A5C36;" id="registrationModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your registration form fields here -->
                    <form  method="post" enctype="multipart/form-data">
                        <!-- Registration form fields go here -->
                        <div class="form-group">
                            <label for="Category" style="color:#0A5C36;">Type:</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="form-group">
                            <label for="description" style="color:#0A5C36;">Description:</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="status" style="color:#0A5C36;">Type:</label>
                            <select name="status" class="form-control" id="status" required>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image" style="color:#0A5C36;">Image:</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div><br>
                        <button type="submit" name="create" class="btn btn-success btn-block">Submit</button></form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
