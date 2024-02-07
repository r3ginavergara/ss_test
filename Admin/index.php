<!DOCTYPE html>
<?php
session_start();



ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');


require_once('../initialize.php');
require_once('../setup/connections.php');
require_once("../config.php")

?>
  <!-- login -->
                        <?php

                           if(isset($_POST['submit'])){

                              $username =$_POST['username'];
                              $password = $_POST['password'];


                              $sql = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
                              $result = mysqli_query($conn,$sql);

							    while($sessionrow=mysqli_fetch_assoc($result)){
                                  $_SESSION["username"]=$sessionrow['username'];
                                  $_SESSION["password"]=$sessionrow['password'];}


                              $count = mysqli_num_rows($result);

                                  if($count == 1){
                              header("location: homepage.php");
                                  }else {
                               $error = "Invalid Credentials!!";
                             }
                            }

                        ?>
<html lang="en">
<?php
$logoquery = $conn->query("SELECT * FROM system_info");
while($rowlogo=mysqli_fetch_assoc($logoquery)){
        $logoicon=$rowlogo['avatar'];}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <link rel="icon" type="image/png" href="<?php echo '../images/'.$logoicon?>" class="border border-success rounded-circle" />

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../images/bg_corn.jpg'); /* Replace 'background.jpg' with your background image file */
            background-size: cover; 
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            transition: 0.8s;
        }
        body:hover{
            background-image: url('../images/bg_ganda.jpg'); /* Replace 'background.jpg' with your background image file */
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
            margin-left:auto;
            margin-right:auto;
            width:50%;

        }

    </style>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../index.php"><img src="<?php echo '../images/'.$logoicon?>" alt="Logo" width="50" height="50" class="d-inline-block align-top "></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
                <a class="nav-link" href="../login.php">Back to Website</a>
              </li>
    </ul>
  </div>
</nav> 
</div>
    <div class="container">
        <div class="row">          
            <!-- Login Container -->
            <div class="col-md-4 login-container">
                <div class="text-center">
                    <img src="../images/sslogo_final.png" alt="Logo" width="80" height="80"> <!-- Replace 'logo.png' with your logo image file -->
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
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
