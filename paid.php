<?php

if(isset($_GET['ei'])){
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
}
?>