<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
$useratm = $_SESSION['user'];
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: login.php");
  exit;
 }
 // select loggedin users detail
 $res = mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow = $res->fetch_assoc();

if((isset($_GET['action']))&&($useratm == 1)){
$adminsql = $_GET['sql'];
$letshope = $conn->query($adminsql);
echo("<br><br><br>");

$headerWritten = false;
echo "Query: {$adminsql}";
echo "<table>";
while ($query_result = mysqli_fetch_assoc($letshope)) {
    // Write header
    if(!$headerWritten) {
        echo "<tr  style='padding:5px;text-align:center'>";
        foreach ($query_result as $columns => $rows) {
            echo "<th  style='padding:5px;text-align:center'>{$columns}</th>";
        }
        echo "</tr>";

        $headerWritten = true;
    }

    // Write rows
    echo "<tr style='padding:5px;text-align:center'>";
    foreach ($query_result as $colums => $rows) {
        echo "<td  style='padding:1px;text-align:center'>$rows</td>";
    }
    echo "</tr>";

}
echo "</table>";


//while($rowdata= mysqli_fetch_array($letshope)){
//echo "<th>{$columns}</th>";
//echo("{$rowdata[0]} {$rowdata[1]} {$rowdata[2]} {$rowdata[3]} {$rowdata[4]} {$rowdata[5]} {$rowdata[6]} {$rowdata[7]}{$rowdata[8]}{$rowdata[9]} <br>");
//echo("</table>");	
//}
}

if(isset($_SESSION['user'])){
if($_SESSION['user'] != 9){
echo("Your attempt has been logged, it is against the law to attempt to hack/test this website without my explicit prior permission in writing , user ID = ");
echo($_SESSION['user']);
} else {
echo("
<!DOCTYPE html>
<html>
<head>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Welcome - {$userRow['userEmail']}</title>
<link rel='stylesheet' href='css/bootstrap.min.css' type='text/css'  />
<link rel='stylesheet' href='css/Custom.css' type='text/css' />
<link rel='stylesheet' href='css/style.css' type='text/css' />
</head>
<body>

 <nav class='navbar navbar-default navbar-fixed-top'>
      <div class='container-fluid'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='admin.php'>Admin Panel</a>
        </div>
        <div id='navbar' class='navbar-collapse collapse'>
          <ul class='nav navbar-nav'>
            <li ><a href='adminusers.php'>Users</a></li>
            <li ><a href='adminorders.php'>Orders</a></li>
          </ul>
          <ul class='nav navbar-nav navbar-right'>
            
            <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
     <span class='glyphicon glyphicon-user'></span>&nbsp;Hi <h8 style='color:red'> {$userRow['userEmail']}</h8> &nbsp;<span class='caret'></span></a>
              <ul class='dropdown-menu'>
                <li><a href='logout.php?logout'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
<br>
<br>
<br>
<br>
<form class='form-horizontal' action='admin.php' method='get'>
<select name='tables'>
<optgroup label='card'>
    <option value='card'>cardDescription</option>
    <option value='cart'>cardID</option>
    <option value='orderdetail'>cardName</option>
    <option value='orders'>cardPicture</option>
    <option value='users'>cardPrice</option>
    <option value='users'>cardRarity</option>
    <option value='users'>cardSet</option>
    <option value='users'>cardStock</option>
    <option value='users'>setNumber</option>
<optgroup label='cart'>
	<option value='users'>cardID</option>
	<option value='users'>cardQuantity</option>
	<option value='users'>selectionID</option>
	<option value='users'>userID</option>
<optgroup label='orderdetail'>
	<option value='users'>orderID</option>
	<option value='users'>selectionID</option>
<optgroup label='orders'>
	<option value='users'>orderID</option>
	<option value='users'>userID</option>
	<option value='users'>completed</option>
<optgroup label='users'>
	<option value='users'>userAddress</option>
	<option value='users'>userEmail</option>
	<option value='users'>userFirst</option>
	<option value='users'>userLast</option>
	<option value='users'>userName</option>
	<option value='users'>userPass</option>
  </select>
<textarea class='form-control' id='sql' name='sql' placeholder='SQL here' rows='7'></textarea><button type='submit' name='action' value='submit' class='btn btn-primary btn-lg'>Submit</button>
</form>
");}
}
?>
<?php ob_end_flush(); ?>