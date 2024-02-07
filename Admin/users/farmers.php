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


require_once('../../initialize.php');
require_once('../../setup/connections.php');
require_once("../../config.php")

?>

<?php
#create query
    if(isset($_POST['create'])){


        $firstname =$_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = "Silang,Cavite,".$_POST['barangay'].",".$_POST['housenumber'].",4118, Philippines";

        

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

        $checkfarmer = "SELECT * FROM users WHERE firstname = '$firstname' and lastname = '$lastname' and username = '$username' and address = '$address'";
        $checkresult = mysqli_query($conn,$checkfarmer);
        $countcheck = mysqli_num_rows($checkresult);

        if($countcheck == 1){
            redirect('Admin/users/farmers.php');
        }else{
            if($firstname && $lastname && $username && $password && $address && $image){
               $newpassword = md5($password);
               $type= 1;
               $date_added= date("Ymd");
               $logintype=1;
            $insertquery = mysqli_query($conn,"INSERT INTO users(firstname,lastname,address ,username,password,avatar,status,login_type,date_added) 
        VALUES ('$firstname','$lastname','$address','$username','$newpassword','$image','$type','$logintype','$date_added')");
        redirect('Admin/users/farmers.php');


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
		<h3 class="card-title">List of Farmers</h3>
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
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Farmer Name</th>
						<th>Username</th>
						<th>Address</th>
						<th>Date joined</th>
						<th>Last Login</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
						$qry = $conn->query("SELECT * FROM users");
							while($row=mysqli_fetch_assoc($qry)){
                                  $id=$row['id'];
                                  $avatar=$row['avatar'];
                                  $name=$row['firstname']." ". $row['lastname'];
                                  $username=$row['username'];
                                  $address=$row['address'];
                                  $datejoined=$row['date_added'];
                                  $status=$row['status'];
                                  $lastlogin=$row['date_updated'];

					?>
						<tr>
							<td ><?php echo $i++; ?></td>
							<td><?php echo $name ?></td>
							<td ><p><?php echo $username ?></p></td>
							<td ><p><?php echo $address ?></p></td>
							<td><?php echo $datejoined ?></td>
							<td><?php echo $lastlogin ?></td>
							<td>
                             <?php if($status == 1): ?>
                             <span class="badge bg-success p-2">Active</span>
                            <?php else: ?>
                                    <span class="badge bg-danger p-2">Inactive</span>
                             <?php endif; ?>
                            </td>
							<td>
							<a  href="manage_farmers.php?id=<?php echo $id ?>" type="button" class="btn btn-outline-success btn-block" >Edit</a>
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
                    <form method="post" enctype="multipart/form-data">
                        <!-- Registration form fields go here -->
                        <div class="form-group">
                            <label for="Firstname" style="color:#0A5C36;">First Name:</label>
                            <input type="text" class="form-control" id="Firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="LastName" style="color:#0A5C36;">Last Name:</label>
                            <input type="text" class="form-control" id="LastName" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="" style="color:#0A5C36;">Barangay:</label><br>
                            <select name="barangay" class="form-control" id="barangay" required>
                              
                            <option value=""></option>
                            
                         <?php
                         $zip = 4118;
					    	$brgyqry = $conn->query("SELECT * FROM philippines_tbl WHERE zipcode = '$zip'");
							while($brgyrow=mysqli_fetch_assoc($brgyqry)){
                                  $barangay=$brgyrow['barangay'];
					        ?>
                            <option value="<?php echo $barangay?>"><?php echo $barangay?></option>
                            <?php }?>
                            </select>
                            <label for="HouseNumber" style="color:#0A5C36;">House Number:</label>
                            <input type="text" class="form-control" id="HouseNumber" name="housenumber" required>
                        </div>
                        <div class="form-group">
                            <label for="Username" style="color:#0A5C36;">Username:</label>
                            <input type="text" class="form-control" id="Username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="Password" style="color:#0A5C36;">Password:</label>
                            <input type="password" class="form-control" id="Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="Avatar" style="color:#0A5C36;">Avatar:</label>
                            <input type="file" accept=".jpg, .png, .jpeg" class="form-control" id="Avatar" name="image" required>
                        </div>
                        <button type="submit" name="create" class="btn btn-success btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>       
    </div>
    
</body>

</html>
