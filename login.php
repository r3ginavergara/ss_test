<!DOCTYPE html>
<?php
session_start();
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');


require_once('initialize.php');
require_once('setup/connections.php');
require_once("config.php")

?>
                        
                        <?php

                           if(isset($_POST['register'])){

                           $firstname = $_POST['firstname'];
                           $lastname = $_POST['lastname'];
                           $gender = $_POST['gender'];
                           $contact = $_POST['contact'];
                           $email = $_POST['email'];
                           $address = $_POST['address'];
                           $newpassword = $_POST['newpassword'];
                           $confirmpassword = $_POST['confirmpassword'];
                           $otp= mt_rand(100000, 999999);

                           if($newpassword == $confirmpassword){
                               $savepassword = md5($confirmpassword);

                              $sql = "SELECT id FROM clients WHERE email = '$email'";
                              $result = mysqli_query($conn,$sql);
                              $count = mysqli_num_rows($result);
                                if($count==0)
                                {
                                //Query for Insert  user data if email not registered 
                                $emailverifiy=2;
                                $login_type=2;
                                $sql="INSERT INTO clients(firstname,lastname,gender,contact,email,default_delivery_address,password,otp,login_type,status) VALUES('$firstname','$lastname','$gender','$contact','$email','$address','$savepassword','$otp','$login_type','$emailverifiy')";
                                $query = mysqli_query($conn,$sql);

                                $lastInsertId = $conn->insert_id;
                                if($lastInsertId)
                                {
                                $_SESSION['email']=$email;	
                                //Code for Sending Email
                                $subject="OTP Verification";
                                $headers .= "MIME-Version: 1.0"."\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                                $headers .= 'From:User Signup<yourname@yourdomain.com>'."\r\n";                          
                                $ms.="<html></body><div><div>Dear $firstname,</div></br></br>";
                                $ms.="<div style='padding-top:8px;'>Thank you for registering with us. OTP for for Account Verification is $otp</div><div></div></body></html>";
                                mail($email,$subject,$ms,$headers); 
                                #echo "<script>window.location.href='verify-otp.php'</script>";
                                }else {
                                echo "<script>alert('Something went wrong.Please try again');</script>";	
                                }}else{
                                echo "<script>alert('Email id already assicated with another account.');</script>";
                                }
                                }

                           }






                            

                        ?>
                        <!-- login -->
                        <?php

                           if(isset($_POST['submit'])){


                              $username =$_POST['username'];
                              $password = $_POST['password'];
                              $newpassword=md5($password);


                              $sql = "SELECT * FROM clients WHERE email = '$username' and password = '$newpassword'";
                              $result = mysqli_query($conn,$sql);
                              $count = mysqli_num_rows($result);

                              $sqlA = "SELECT * FROM users WHERE username = '$username' and password = '$newpassword'";
                              $resultA = mysqli_query($conn,$sqlA);
                              $countA = mysqli_num_rows($resultA);



                                  if($count == 1){

                            while($clientrow=mysqli_fetch_assoc($result)){
                                            
                                          $_SESSION["id"]=$clientrow['id'];
                                          $_SESSION["username"]=$clientrow['email'];
                                          $_SESSION["password"]=$clientrow['password'];
                                          $_SESSION["login_type"]=$clientrow['login_type'];
                                          $_SESSION["status"]=$clientrow['status'];}

                             header("location: Buyers/");
                                  }elseif($countA == 1){

                            while($famerrow=mysqli_fetch_assoc($resultA)){
                                          $_SESSION["username"]=$famerrow['username'];
                                          $_SESSION["password"]=$famerrow['password'];
                                          $_SESSION["login_type"]=$famerrow['login_type'];
                                          $_SESSION["status"]=$famerrow['status'];}

                             header("location: Farmers/");



                             }else {
                               $error = "Invalid Credentials!!";
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
    <title>Login Page</title>
    <link rel="icon" type="image/png" href="<?php echo 'images/'.$logoicon?>" class="border border-success rounded-circle" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('images/bg_corn.jpg'); /* Replace 'background.jpg' with your background image file */
            background-size: cover; 
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            transition: 0.8s;
        }
        body:hover{
            background-image: url('images/bg_ganda.jpg'); /* Replace 'background.jpg' with your background image file */
            background-size: cover; 
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
        }
        .container{
            margin-top: 5%;

        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            
            width: 50%; /* Adjust the width of the login container */
        }
        .slideshow-container {
            max-width: 50%; /* Adjust the width of the slideshow container */
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: auto; /* Move it to the right */
            margin-right: auto; /* Move it to the left */
        }
        .carousel-inner img {
            width: 100%;
            height: auto;
        }
        .modal{
            margin-top: %;
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
    <div class="container">
        <div class="row">
            

            <!-- Slideshow Container -->
            <div class="col-md-8 slideshow-container">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img src="images/bg_ganda.jpg" class="d-block w-100" alt="Image 1">
                        </div>

                        <?php
                            $bannersquery = $conn->query("SELECT * FROM banners");
		                    while($rowbanner=mysqli_fetch_assoc($bannersquery)){
                                    $banner=$rowbanner['banner'];
		                    ?>
                        <div class="carousel-item">
                            <img src="<?php echo 'banners/'.$banner?>" class="d-block w-100" alt="Image 2"> <!-- Replace 'image2.jpg' with your image file -->
                        </div>
                        <?php }?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- Login Container -->
            <div class="col-md-4 login-container">
                <div class="text-center">
                    <img src="images/sslogo_final.png" alt="Logo" width="80" height="80"> <!-- Replace 'logo.png' with your logo image file -->
                    <h2 class="mt-3" style="color:#0A5C36;">Login</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <!-- Your login form here -->
                    <div class="form-group">
                        <label for="username" style="color:#0A5C36;">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" style="color:#0A5C36;">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
    
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-block">Login</button>
                    <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#registrationModal">Register</button>
                </form>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
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
                    <form enctype="multipart/form-data" method="post">
                        <!-- Registration form fields go here -->
                        <div class="form-group">
                            <label for="image" style="color:#0A5C36;">Choose Avatar:</label>
                            <input type="file" class="form-control" id="image" name="image" >
                        </div>
                        <div class="form-group">
                            <label for="newUsername" style="color:#0A5C36;">First Name:</label>
                            <input type="text" class="form-control" id="newUsername" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword" style="color:#0A5C36;">Last Name:</label>
                            <input type="text" class="form-control" id="newPassword" name="lastname" required>
                        </div>
                         <label for="status" style="color:#0A5C36;">Gender:</label>
                                <select name="gender" class="form-control" id="status" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                        <div class="form-group">
                            <label for="newPassword" style="color:#0A5C36;">Contact Number:</label>
                            <input type="tel" class="form-control" id="newPassword" name="contact" pattern="[0-9]{11}" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword" style="color:#0A5C36;">Email Address:</label>
                            <input type="email" class="form-control" id="newPassword" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword" style="color:#0A5C36;">Delivery Address:</label>
                            <input type="text" class="form-control" id="newPassword" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword" style="color:#0A5C36;">Password:</label>
                            <input type="password" class="form-control" id="newPassword" name="newpassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword" style="color:#0A5C36;">Confirm Password:</label>
                            <input type="password" class="form-control" id="newPassword" name="confirmpassword" required>
                        </div>

                        <button type="submit" name="register" class="btn btn-success btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div
