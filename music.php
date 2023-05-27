<?php
include 'conn.php';
include 'session.php';

if(isset($_POST['add'])){
	
	$title = $_POST['title'];
	$artist = $_POST['artist'];
	$genre = $_POST['genre'];
	$file = '';

	$targetDir = "files/"; // Directory to store uploaded files
    $fileName = basename($_FILES["file"]["name"]); // Get the name of the file

    $targetFilePath = $targetDir . $fileName; // Path to store the uploaded file

    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // Get the file extension

    try{

			if (!move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
			
			
				echo '<div class="alert alert-danger" role="alert">Error uploading file. </div>';
				header('location:music.php');
			}
		
		

		$insert = "insert into music (title,artist,genre,file) values ('$title','$artist','$genre','$targetFilePath')";
		
		if($conn->query($insert)== TRUE){

				echo '<div class="alert alert-success" role="alert">Sucessfully add data </div>';
				// header('location:music.php');
		}else{

			echo '<div class="alert alert-danger" role="alert">Ooppss cannot add data' . $conn->connect_error.' </div>';
			// header('location:music.php');
		}
		
	}catch(Exception $e ){
		echo '<div class="alert alert-danger" role="alert">Ooppss cannot add data' . $e->getMessage().' </div>';
			// header('location:music.php');
	}
}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/mycss.css">
		<title>
			Music
		</title>
		<?php include('libraries.php') ?>
		</head>
	<body>
		<div id="body">
			<?php include('menu.php') ?>
			<div id="content">
				<br>
				<form class="form-inline" action="music.php" method="POST" enctype="multipart/form-data">
				<table align="center">
					<tr>
						<td> &nbsp;Title: <input class="form-control" type="text" name="title" value="" placeholder="Type title here" required /></td>
						
						<td> &nbsp;Artist: <input class="form-control" type="text" name="artist" placeholder="Type Artist here.." required /></td>
					
						<td> &nbsp;Genre: <input class="form-control" type="text" name="genre" placeholder="Type genre here.." required /></td>
						<td>&nbsp; File: <input  type="file" name="file"  required /></td>
					
						<td><input class="btn btn-success" type="submit" name="add" value="Add" /></td>
						
						</tr>
				</table>
			</form>
				<br>
				<form class="form-inline" action="#" method="get" ecntype="multipart/data-form">
						<table align="center">
							<tr>
								<td>Search: 
									<input class="form-control" type="text" name="query" value="<?php echo $_GET['query'] ?? '' ; ?>">
								<input type="submit" class="btn btn-primary" value="Search" name="search">
								<a href="music.php" class="btn btn-danger">Clear search</a>
							</td>
							</tr>
						</table>
				</form>
				<table class="table table-bordered" align="center" border="1" cellspacing="0" width="500">
					<tr>
					<th>First Name</th>
					<th>Artist</th>
					<th>Genre</th>
					<th>File</th>
					<th>Action</th>
					</tr>
					<?php
					$sql = "SELECT * FROM music";
					if(isset($_GET['search'])){
						$query = $_GET['query'];

						$sql = "select * from music where title like '%$query%' or artist like '%$query%' or genre like '%$query%'";

					}
					$result = $conn->query($sql);
					if($result->num_rows > 0){
					while($row = $result->fetch_array()){
						?>
						<tr>
							<td align="center"><?php echo $row['title'];?></td>
							<td align="center"><?php echo $row['artist'];?></td>
							<td align="center"><?php echo $row['genre'];?></td>
							<td align="center"><a target="_blank" download="" href="<?php echo dirname($_SERVER['PHP_SELF']).'\\'.$row['file'];?>">Download File</a></td>
							<td align="center"><a href="edit.php?id=<?php echo md5($row['id']);?>">Edit
							</a>/<a href="delete.php?id=<?php echo md5($row['id']);?>">Delete</a></td>
						</tr>
						<?php
							}	
						}else{
							echo "<center><p> No Records</p></center>";
						}
				
				$conn->close();
				?>
				</table>
			</div>
		</div>
		</body>

</html>