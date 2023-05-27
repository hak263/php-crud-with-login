<?php
include 'conn.php';
include 'session.php';

$id = $_GET['id'];
$view = "SELECT * from music where md5(id) = '$id'";
$result = $conn->query($view);
$row = $result->fetch_assoc();

if(isset($_POST['update'])){

	$ID = $_GET['id'];

	$title = $_POST['title'];
	$artist = $_POST['artist'];
	$genre = $_POST['genre'];
	$file = '';

	$insert = "UPDATE music set title = '$title', artist = '$artist',genre='$genre',file='$file' where md5(id) = '$ID'";
	
	if($conn->query($insert)== TRUE){

			echo "Sucessfully update data";
			header('location:music.php');			
	}else{

		echo "Ooppss cannot add data" . $conn->error;
		header('location:music.php');
	}
	$conn->close();
}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/mycss.css">
		<title>
			Edit Music
		</title>
		<?php include('libraries.php') ?>
		</head>
	<body >
		<div id="body">
		<?php include('menu.php') ?>
			<div id="content">
				<br>
				<form  class="form-inline" action="" method="POST">
				<table align="center">
					<tr>
						<td>Title: <input class="form-control" type="text" name="title" value="<?php echo $row['title'];?>" placeholder="Type title here" required></td>
						
							<td>Artist: <input class="form-control" type="text" name="artist"  value="<?php echo $row['artist'];?>" placeholder="Type Artist here.." required></td>
						
							<td>Genre: <input class="form-control" type="text" name="genre"  value="<?php echo $row['genre'];?>" placeholder="Type Genre here.." required></td>
							
						</tr>
						<tr>
							<td>
								<br>
										uploaded File : <a  download="" target="_blank" href="<?php echo dirname($_SERVER['PHP_SELF']).'\\'.$row['file'];?>">Download File</a>
							</td>
						<td><br>&nbsp; File: <input class="" type="file" name="file"  required></td>
							<td><br><input type="submit" class="btn btn-success" name="update" value="Update"></td>
						</tr>
				</table>
			</form>
				<br>
			
			</div>
		</div>
		</body>

</html>