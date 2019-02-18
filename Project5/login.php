<html>
<head>
	<title>Message Board</title>
	<style>
		form{
			margin: auto;
			display: block;
			text-align: center;
		}
		.input-box-container{
			display: inline-block;
			padding: 20px;
			border: 2px dashed #eee;
		}
		input{
			margin: 10px auto;
			display: block;
			border: 1px solid #eee;
			padding: 5px;
		}
		.submit-btn{
			padding: 10px;
			border-radius: 5px;
		}
	</style>
</head>
<body>
 <?php
   session_start();
   $error = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
		try {
			//echo "Hello";
			$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$dbh->beginTransaction();
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			
			$stmt = $dbh->prepare('select * from users where username="'. $username . '" and password ="' . $password . '"');
			$stmt->execute();
			//print_r($stmt);
			$count = $stmt->rowCount();
			//echo "<br />" . $count;
			while ($row = $stmt->fetch()) {
			  $fullName = $row["fullname"];
			}
			if($count == 1) {
				$_SESSION['loginUser'] = $username;
				$_SESSION['fullName'] = $fullName;
				//echo $_SESSION['fullnName'];
				header("location: board.php");
			}else{
				$error = "Your Username or Password is invalid";
			}
			
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		
	}

 ?>
<form class="form-inline" method = "post">
	<div class="input-box-container">
		<h3>Sign in</h3>
		<input type="text" name="username" placeholder="Username" required>
		<input type="password" name="password" placeholder="Password" required>
		<?php echo $error; ?>
		<input class="submit-btn" type="submit" value="Submit">
	</div>
</form>

</body>
</html>
