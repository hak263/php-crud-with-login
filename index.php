<?php
	include 'conn.php';
	session_start();

	if(isset($_SESSION['userID'])){

		header('location:home.php');
	}

	if(isset($_POST['log'])){

		$user = $_POST['username'];
		$pass =  $_POST['pass'];

		$sql = "SELECT * FROM users where username = '$user'";
		$result = $conn->query($sql);

		if($result-> num_rows > 0){
			while($row= $result->fetch_assoc()){
				$verify = password_verify($pass, $row['password']);
				if($verify){

					$_SESSION['userID'] = $row['userID'];
					$_SESSION['username'] = $row['username'];	

					
					echo "<script>window.location='home.php';</script>";
				}else{
					echo '<div class="alert alert-danger" role="alert">
								Invalid password</p>
				 		  </div>';
					
				}	
			}
			?>		
			
			<?php		
			}else{
				echo '<div class="alert alert-danger" role="alert">
								Invalid username or password</p>
				 		  </div>';

		}
		$conn->close();
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="./css/style.css" rel="stylesheet" >
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
<body>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		
			<!-- Tabs Titles -->

			<!-- Icon -->
			<div class="fadeIn first">
			<img src="./images/login.png" id="icon" alt="User Icon" />
			</div>

			<!-- Login Form -->
			<form action="index.php" method="POST">
			<input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
			<input type="password" id="password" class="fadeIn third" name="pass" placeholder="password">
			<input type="submit" class="fadeIn fourth" name="log" value="Log In">
			</form>

		</div>
	</div>
	
</body>


</html>
