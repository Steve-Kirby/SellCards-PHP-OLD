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
?> 
 <?php


if(isset($_GET['remove']))
{
$useid = $_SESSION['user'];
$removecard = $_GET['remove'];	
$removes ="DELETE FROM `cart` WHERE `cardID` = '$removecard' and `userID` = '$useid'";
$perform = $conn->query($removes);
echo("<script>window.location('account.php')</script>");

}
?>
<?php
if(isset($_POST['checkout']))
{
$useid = $_SESSION['user'];
$neworder ="INSERT INTO `orders`(`orderID`, `userID`) VALUES ('','$useid')";
$performorder = $conn->query($neworder);
$sql="SELECT * FROM cart WHERE userID =".$_SESSION['user'];
$query= mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($query)) {
				$querys= "INSERT INTO `orderdetail`(`orderID`, `selectionID`) VALUES (LAST_INSERT_ID(),{$row['cardID']})";
				  $performit = $conn->query($querys);
				    echo("testing");
				}

$cartempty = "DELETE FROM cart where userID = {$useid}";
$deadcart = mysqli_query($conn,$cartempty);
}
	
?>



<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">


<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
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
            <li class="active"><a href="account.php">Your Account</a></li>
            <li ><a href="index.php?search=&sortorder=Price">Search</a></li>
            <li><a href="contact.php">Contact us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
     <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <h8 style='color:red'><?php echo $userRow['userEmail']; ?></h8> &nbsp;<span class="caret"></span></a>
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

            <div class="col-md-4">
               <!-- <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Old Cards</a>
                    <a href="#" class="list-group-item">New Cards</a>
                    <a href="#" class="list-group-item">Special Offers</a>
                </div>
				<p class="lead">Filters</p>
				<div class="list-group">
                    <a href="#" class="list-group-item">Price slider</a>
                    <a href="#" class="list-group-item">Set Drop down</a>
                    <a href="#" class="list-group-item">Rarity drop down</a>
                </div>-->
				<p class="lead">Account Details</p>
				<div class="list-group">
				
				    <a class='list-group-item'>User Name: <?php echo $userRow['userName']; ?></a>
					<a class='list-group-item'>First Name: <?php echo $userRow['userFirst']; ?></a>
                    <a class='list-group-item'>Last Name: <?php echo $userRow['userLast']; ?></a>
                    <a class='list-group-item'>Email: <?php echo $userRow['userEmail']; ?></a>
					<a class='list-group-item'>Address: <?php echo $userRow['userAddress']; ?></a>
				</div>
				<div class="list-group">	
					<a href='#' class='list-group-item'>Previous Orders</a>
				
                </div>
				
				<div class="list-group">	
					<a href='#' class='list-group-item'>Change Password </a>
				
                </div>
				
				
            </div>

            <div class="col-md-8">

<p class='lead'>Cart</p>
				
				<div class="container-fluid">
				
				<?php
$sql="SELECT * FROM cart WHERE userID =".$_SESSION['user'];
$query= mysqli_query($conn,$sql);
$count = mysqli_num_rows($query);
$colum = 1;
$total = 0.00;
if($count == 0){
      $output = "Your cart is Empty!";
		print ("$output");
    }else{
		      while ($row = mysqli_fetch_array($query)) {
$carddata= mysqli_query($conn,"SELECT * FROM card WHERE cardID={$row['cardID']}");
				while($row2 = mysqli_fetch_array($carddata)){
if ($colum == 1){						
        echo("<div class='row'>
	<div class='col-sm-4 col-lg-4 col-md-4'>		
				<div class='list-group'>
				<a href='#' class='list-group-item'>Card ID:{$row2['cardID']}</a>
				<a href='#' class='list-group-item'>Card Name:{$row2['cardName']}</a>
                <a href='#' class='list-group-item'>Price:£{$row2['cardPrice']}</a>
				
				</div>

			
</div>
				
					
				<div class='col-sm-2 col-lg-2 col-md-2'>
				
							<img src='{$row2['cardPicture']}' style='max-height:220px;margin-bottom:20px;'alt=''>
				
				
				
				
				
				
			<form action='' method='get'>
							<button name='remove' value='{$row['cardID']}' style='margin-bottom:20px;'>Remove</button>
				</form>
				
				
				
                </div>
				
				");
$total += $row2['cardPrice'];
$colum += 1;
} else {
	 echo("<div class='col-sm-4 col-lg-4 col-md-4'>		
				<div class='list-group'>
				<a href='#' class='list-group-item'>Card ID:{$row2['cardID']}</a>
				<a href='#' class='list-group-item'>Card Name:{$row2['cardName']}</a>
                <a href='#' class='list-group-item'>Price:£{$row2['cardPrice']}</a>
				
				</div>

			
</div>
					
					
				<div class='col-sm-2 col-lg-2 col-md-2'>
				
							<img src='{$row2['cardPicture']}' style='max-height:220px;margin-bottom:20px;'alt=''>
				
				
				
				
				
				
			<form action='' method='get'>
							<button name='remove' value='{$row['cardID']}' style='margin-bottom:20px;'>Remove</button>
				</form>
				
				
				
                </div>
		</div>		
				");
	$colum -= 1;	
	$total += $row2['cardPrice'];
}
			}
			$total = number_format($total, 2);
			  }
}	
?>		

</div>
<div class='row'>

				<a href='pay.php' class='list-group-item'>Total: £<?php echo "$total" ?>	Checkout With PayPal	</a>
 

</a>
				
</div>
            </div>
</div>
        </div>

    </div>
    <!-- /.container -->
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
 