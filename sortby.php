<?php
$q = intval($_GET['sortorder']);

require_once 'dbconnect.php';

$sql="SELECT * FROM card ORDER BY '".$q."'";
$query = mysqli_query($conn,$sql);

$count = mysqli_num_rows($query);

 while ($row = mysqli_fetch_array($query)) {

        echo("<div class='col-sm-2 col-lg-2 col-md-2' style='padding-right:0px';>
                        <div class='thumbnail'>
                            <img src='{$row['cardPicture']}' alt=''>
                            <div class='caption'>
                                <h5 class='pull-right' style='color:green';>£{$row['cardPrice']}</h5>
                                <h5><a href='#'>{$row['cardName']} </a></h5>
								<p class='truncate'> {$row['cardDescription']} </p>
								<h5 class='pull-left' style='color:red';>{$row['setNumber']}</h5>
								<h5 class='pull-right'><a href='#'>{$row['cardSet']} </a></h5>
                            </div>
                            
                        </div>
                    </div>");
		print ("$output");
}

      
mysqli_close($con);
?>
</body>
</html>