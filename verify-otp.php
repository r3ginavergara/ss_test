<!DOCTYPE html>
<?php
session_start();
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');


require_once('initialize.php');
require_once('setup/connections.php');
require_once("config.php");

if($_SESSION['email']=='' ){
echo "<script>window.location.href='login.php'</script>";
}else{
 
//Code for otp verification
if(isset($_POST['verify'])){
//Getting Post values
$emailid=$_SESSION['email'];	
$otp=$_POST['emailotp'];	
// Getting otp from database on the behalf of the email
$stmt=$conn->prepare("SELECT otp FROM  clients where email='$emailid'");
$stmt->execute(array(':emailid'=>$emailid)); 
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
$dbotp=$row['emailOtp'];
}
if($dbotp!=$otp){
echo "<script>alert('Please enter correct OTP');</script>";	
} else {
$emailverifiy=1;
$sql="update tblusers set isEmailVerify=:emailverifiy where emailId=:emailid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':emailverifiy',$emailverifiy,PDO::PARAM_STR);
$query->execute();	
session_destroy();
echo "<script>alert('OTP verified successfully');</script>";	
echo "<script>window.location.href='login.php'</script>";
}}
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
            margin-top: 6%;
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
                    <h2 class="mt-3" style="color:#0A5C36;">Verify OTP</h2>
                </div>
                <form  method="post">
<div class="form-header">
</div>
<div class="form-group">
<label>Email OTP</label>
<input type="text" class="form-control" name="emailotp" maxlength="6" required="required">
</div>
 
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block btn-lg" name="verify">Verify</button>
</div>	
</form>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


               