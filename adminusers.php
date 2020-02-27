<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: login.php");
  exit;
 }
 // select loggedin users detail
 $res = mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow = $res->fetch_assoc();

if(isset($_SESSION['user'])){
if($_SESSION['user'] != 1){
echo("Your attempt has been logged, it is against the law to attempt to hack/test this website without my explicit prior permission in writing , user ID = ");
echo($_SESSION['user']);
} else {
	include 'admin.php';
}
}
?>