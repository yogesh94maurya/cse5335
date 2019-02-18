<html>
<head>
	<title>Message Board</title>
	<style>
		body{
			margin: 0px;
			padding: 0px;
		}
		form{
			margin: auto;
			display: block;
			text-align: center;
		}
		.input-box-container{
			display: inline-block;
			padding: 20px;
			border: 2px dashed #eee;
			margin-bottom: 10px;
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
		.menu{
			text-align: right;
			background: #aaa;
			padding: 5px;
			margin-bottom: 10px;
			padding: 15px;
		}
		.logout{
			margin: 10px;
			border: 1px solid #eee;
			padding: 5px;
			border-radius: 5px;			
		}
		table{
			width: calc(100% - 20px);
			margin: 0px 10px;
		}
		th{
			text-align: center;
			border: 2px dashed #eee;
		}
		td{
			border: 2px dashed #eee;
			padding: 0px 5px;
		}
	</style>
</head>
<body>
<?php
	
	session_start();
	
	if(isset($_GET["logout"])){
		if(session_destroy()) {
		  header("Location: login.php");
		}
	}	
	if(!isset($_SESSION['loginUser'])){
      header("location:login.php");
    }
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		try{
			$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$dbh->beginTransaction();
			$id = uniqid();
			$replyto = null;
			if(isset($_GET["replyto"])){
				$replyto = $_GET["replyto"];
			}
			$postedby = $_SESSION['loginUser'];
			$message = $_POST["message"];
			$datetime = date("Y-m-d h:i:sa");
			//$stmt = $dbh->prepare('insert into posts values("' . $id . '","' . $replyto . '","' . $postedby . '",' . $date . ',"' . $message '")');
			//$stmt = $dbh->prepare('insert into posts values("124","123","Yogesh",' . Date("2017-11-07 11:11:11") . ', "Hello")');
			//$stmt->execute();
			// $dbh->exec('insert into posts values("' . $id . '","' . $replyto . '","' . $postedby . '",' . $date . ',"' . $message . '")')
				// or die(print_r($dbh->errorInfo(), true));
			// $dbh->commit();	

			$stmt = $dbh->prepare("INSERT INTO posts(id, replyto, postedby, datetime, message) VALUES(:id, :replyto, :postedby, :datetime, :message)");
			//$stmt = $dbh->prepare("INSERT INTO posts(id, replyto, postedby, message) VALUES(:id, :replyto, :postedby, :message)");
			$stmt->bindparam(":id", $id);
			$stmt->bindparam(":replyto", $replyto);
			$stmt->bindparam(":postedby", $postedby);            
			$stmt->bindparam(":datetime", $datetime);            
			$stmt->bindparam(":message", $message);            
			$stmt->execute();
			$dbh->commit();
			
		}catch(PDOException $e){
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}


?>
<div class="menu">
<span>Welcome <?php echo $_SESSION["fullName"];?>!</span>
<!--<input type="submit" value="Logout" formAction="board.php?logout=1">-->
<a href="board.php?logout=1" class="logout">Logout</a>
</div>
<form class="form-inline" method = "post">
	<div class="input-box-container">
		<h3>New Post</h3>
		<textarea name="message" rows="4" cols="50" placeholder="Enter your message here" required></textarea><br>
		<input type="submit" value="New Post" formAction="board.php">
	</div>

<?php 
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	try {
		$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$dbh->beginTransaction();
		$stmt = $dbh->prepare('select id, username, fullname, datetime, replyto, message from users, posts where users.username = posts.postedby ORDER BY datetime DESC');
		$stmt->execute();
		
		if($stmt->rowCount() >= 1){
			$postTable = "<table><thead><tr><th>Message Id</th><th>Username</th><th>Full Name</th><th>Posted Date</th><th>Reply to</th><th>Message</th><th>Reply</th></tr></thead><tbody>";
			
			while ($row = $stmt->fetch()) {
				//$postTable .= "<tr><td>". $row->datetime . "</td><td>" . $row->message . "</td><td>" . $row->postedby . "</td><td><input type='submit' formAction='board.php?replyto=" . $row->id . "'></td></tr>";	
				$postTable .= "<tr><td>". $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["fullname"] . "</td><td>" . $row["datetime"] . "</td><td>" . $row["replyto"] . "</td><td>" . $row["message"] . "</td><td><input type='submit' value='Reply' formAction='board.php?replyto=" . $row["id"] . "'></td></tr>";	
				//print_r($row);
			}
			$postTable .= "</tbody></table>";
			echo $postTable;
		}
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>
</form>
</body>
</html>
