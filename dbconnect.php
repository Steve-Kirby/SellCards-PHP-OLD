<?php

error_reporting( ~E_DEPRECATED & ~E_NOTICE );

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";


$conn = new mysqli($servername, $username, $password, $dbname);

 if ( !$conn ) {
  die("Connection failed : " . mysqli_error());
 }
 ?>