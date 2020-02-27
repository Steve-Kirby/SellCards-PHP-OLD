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
<?php
echo("
<div class='container-fluid'>

<div class='row'>

<div class='col-md-12'><br>
<br>
<br>");

$sqlage = "SELECT * FROM card WHERE cardStock > 0";
$resultys = $conn->query($sqlage);

if ($resultys->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Rarity</th><th>Price</th><th>Set</th><th>Stock</th><th>Set Number</th></tr>";
    // output data of each row
    while($rows = $resultys->fetch_assoc()) {
        echo "<tr><td>".$rows["cardID"]."</td><td>".$rows["cardName"]."</td><td>".$rows["cardRarity"]."</td><td>£".$rows["cardPrice"]."</td><td>".$rows["cardSet"]."</td><td>".$rows["cardStock"]."</td><td>".$rows["setNumber"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
echo("

</div>
</div>


</div>");
?>