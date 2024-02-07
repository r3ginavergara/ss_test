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
#delete query


     $delete_id = $_GET['id'];


     $deletequery="DELETE FROM banners where id='$delete_id'";
     $deleteconfirm = mysqli_query($conn,$deletequery);
     redirect('Admin/settings/systemsett.php'); 




 
 ?>