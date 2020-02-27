<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if(isset($_SESSION['user'])) {
  $result = mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow = $result->fetch_assoc();
  $guest = $userRow['userEmail'];
} else {
  $guest = "Guest";
}
 // select loggedin users detail

 

$cardid =($_GET['id']);
 ?>
 <?php

if(isset($_GET['add']))
{
echo("<script>window.location.href ='index.php?search=&sortorder=Price'</script>");
$useid = $_SESSION['user'];
$cardid = $_GET['add'];
$insert="INSERT INTO `cart`(`userID`, `cardID`) VALUES ('$useid','$cardid')";
$doit= $conn->query($insert);


}
?>
 <!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $guest; ?></title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="css/Custom.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
   <script src="js/jquery-3.1.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?search=">SellCards</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="account.php">Your Account</a></li>
            <li class="active"><a href="index.php?search=">Search</a></li>
            <li><a href="contact.php">Contact us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
     <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <h8 style='color:red'><?php echo $guest; ?></h8> &nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

 <div id="wrapper">

 <div class="container-fluid" style='margin-right:10px, margin-left:10px'>
    
     <div class="page-header">
     <h3></h3>
     </div>
        
        <div class="container-fluid">

        <div class="row">

            <div class="col-md-2">
               <!-- <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Old Cards</a>
                    <a href="#" class="list-group-item">New Cards</a>
                    <a href="#" class="list-group-item">Special Offers</a>
                </div>
				-->
				<p class="lead">Search</p>
								<form action ="index.php" method = "get">
  				<div class="col-md-9" style="margin-left:-14px;">
				<input class="search-query form-control" name="search" type="text" size="30" placeholder="Search"/>
				</div>
				<input class="btn btn-danger" type="submit" value="Search"/>
				</form> 
				
				
            </div>
      <div class="col-md-10">
			
<?php
$sql="SELECT * FROM card WHERE cardID ={$cardid}";
$query= mysqli_query($conn,$sql);
$count = mysqli_num_rows($query);

if($count == 0){
      $output = "There was no search results!";
		print ("$output");
    }else{
		      while ($row = mysqli_fetch_array($query)) {
if($row['cardStock'] !=0) {
        echo("<div class='col-sm-12 col-lg-12 col-md-12' style='padding-right:0px'>
                        <div class='thumbnail'>
                            <img src='img/{$row['cardPicture']}' alt=''>
                            <div>
                                <h5 class='pull-right' style='color:green;font-size: 5vmin'>£{$row['cardPrice']}</h5>
                                <h5 style='font-size: 5vmin';><a href='Card.php?id={$row['cardID']}'>{$row['cardName']} </a></h5>
								<p> {$row['cardDescription']} </p>
								<h5 class='pull-right'style='font-size: 5vmin'><a href='#'>{$row['cardSet']} </a></h5>
								<h5 class='pull-left' style='color:red'>{$row['setNumber']}</h5>
								<br><br>
								<h6 class='pull-right'style='font-size: 5vmin'>Stock({$row['cardStock']})</h6>
								<h6 style='margin-top:-5px;font-size: 5vmin'>{$row['cardRarity']}</h6>
								
                            </div>
                            
                        </div>
                    </div>");
}
}
	}				
	

?>
<?php
echo("
<form action='' method='get'>
<button name='add' value='$cardid'>Add to Cart!</button>
</form>");

?>
<?php ob_end_flush(); ?>