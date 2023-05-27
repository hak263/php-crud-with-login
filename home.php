<?php
include 'session.php';
$username = $_SESSION['username'];
$userID = $_SESSION['userID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/mycss.css">
		<title>
			Home
		</title>
		<?php include('libraries.php') ?>
	</head>
	<body>
		<div id="body">
		<?php include('menu.php') ?>
			<div id="content">
			
			<h1>Welcome <?php echo $username;?></h1>
				<h3 style="color:blue;"><?php echo "Today is".  "  ". date("M/d/y") . " - " . date("l") . ""?>&nbsp; <?php echo "" . date("h:i:sa") . ""?></h3>
				
				
				

			</div>

		
		</div>
		</body>

</html>