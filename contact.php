 <?php
//require 'PHPMailer/PHPMailerAutoload.php';
//error_reporting(-1);
//ini_set('display_errors', 'On');
//set_error_handler("var_dump");
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
 
?>
<!DOCTYPE html>
<html >
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $guest; ?></title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="css/Custom.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
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
          <a class="navbar-brand" href="index.php">SellCards</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="account.php">Your Account</a></li>
            <li ><a href="index.php">Search</a></li>
            <li class="active"><a href="contact.php">Contact us</a></li>
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

 <div class="container-fluid" style='margin-right:10px, margin-left:10px';>
    
     <div class="page-header">
     <h3></h3>
     </div>
        
        <div class="container-fluid">

        <div class="row">

            <div class="col-md-2">
              
				<p class="lead">Search</p>
								<form action ="index.php" method = "get">
  				<div class="col-md-9" style="margin-left:-14px;">
				<input class="search-query form-control" name="search" type="text" size="30" placeholder="Search"/>
				</div>
				<input class="btn btn-danger" type="submit" value="Search"/>
				</form> 
				<?php print ("$output");?>
				
            </div>

            <div class="col-md-10">
				<div class="row">
				<div class="col-md-7" style="border-right-style:solid;">
				<p class="lead">Contact us by Email!</p>
				
<!-- Contact Form - START -->
<!--<div class="container">-->
    <div class="row">
        <div class="col-md-10">
            <div class="well well-sm">
                <form class="form-horizontal" action="mail2.php" method="get">
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-1 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-10">
                                <input id="fname" name="fname" type="text" placeholder="First Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-1 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-10">
                                <input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-1 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-10">
                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-1 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-10">
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                           <span class="col-md-1 col-md-1 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-10">
                                <textarea class="form-control" id="message" name="message" placeholder="Enter your message for us here. We will get back to you as soon as possible!" rows="7"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="action" value="send" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<!--</div>-->
<style>
    .header {
        color: #36A0FF;
        font-size: 27px;
        padding: 10px;
    }

    .bigicon {
        font-size: 35px;
        color: #36A0FF;
    }
</style>

<!-- Contact Form - END -->


				
				
				
				</div>
				<div class="col-md-4" style="padding-left:5%;">
				<p class="lead">Contact us by Phone!</p>
				</div>
				
				<div class="col-md-4" >
				<p class="lead" style="text-align:center;"> </p>

				<p class="lead" style="text-align:center;">01234 567890</p>
				<p class="lead" style="text-align:center;">09876 543210</p>
				<p class="lead" style="text-align:center;">01234 234567</p>
				<br>
				<br>
				<p style="text-align:center;">Opening hours: </p>
				<p style="text-align:center;">Monday-Friday:10am-6pm gmt</p>
				<p style="text-align:center;">Saturday & Sunday:11am-3pm gmt</p>
				</div>
				
				
				
				</div>
                <div class="row carousel-holder" style='margin-top:15px';>

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="https://www.toymadness.com.au/sites/default/files/styles/product_category_banner/public/product-banner/Pokemon_Banner.jpg?itok=JemvQqYl" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/1400x200" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/1400x200" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

				<div id='pop2' class="row"><?php

  include "Dbconnect.php";

  $output = '';

  if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $search = preg_replace("#[^0-9a-z]i#","", $search);
	$sql="SELECT * FROM card WHERE cardName LIKE '%$search%' ORDER BY {$sort}";
    $query = mysqli_query($conn,$sql) or die ("Could not search");
	
    $count = mysqli_num_rows($query);
	
    
    if($count == 0){
      $output = "There was no search results!";
		print ("$output");
    }else{
		      while ($row = mysqli_fetch_array($query)) {
if($row['cardStock'] !=0) {
        echo("<div id='restrict' class='col-sm-1 col-lg-1 col-md-1' style='padding-right:0px;padding-left:0px';>
                        <div id='pop' class='thumbnail' style='min-width:225px;padding-right:0px;padding-left:0px;padding-top:0px;padding-bottom:0px;border-radius:11px;border:0px;';>
                            <a href='Card.php?id={$row['cardID']}'> <img src='{$row['cardPicture']}' style='border-radius: 10px;'  alt=''></a></img>
                            <div class='caption'>
                                <h5 class='pull-right' style='color:green;font-size: 1.3vmin';>£{$row['cardPrice']}</h5>
                                <h5 style='font-size: 1.6vmin';><a href='Card.php?id={$row['cardID']}'>{$row['cardName']} </a></h5>
								<h5 class='pull-right'style='font-size: 1.5vmin';><a href='#'>{$row['cardSet']} </a></h5>
								<h5 class='pull-left' style='color:red';>{$row['setNumber']}</h5>
								<br><br>
								<h6 class='pull-right'style='font-size: 1.15vmin'>Stock({$row['cardStock']})</h6>
								<h6 style='margin-top:-5px;font-size: 1.1vmin;';>{$row['cardRarity']}</h6>
								
                            </div>
                        </div> 
                        <div id='cover'> </div>
                    </div>");
		print ("$output");
}
}

      }

    }
  

  ?>
                

                    

                </div>
<div id='cover'> </div>
            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Steven Kirby 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- //<p class='truncate'> {$row['cardDescription']} </p>/.container -->

    
    </div>
    
    </div>
    
    <script src="js/jquery-3.1.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
 