<?php
	date_default_timezone_set('Europe/Copenhagen');
	include '../modules/comments.php';
	include '../config.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>comment</title>
</head>
<body>
	<?php
	$conn = Database::getInstance();
	$id_comment = $_POST['id_comment'];
	$date = $_POST['date'];
	$username = $_POST['username'];
	$message = $_POST['message'];
	
	echo 
	"<form method='POST' action='".editComments($conn)."'>
		<input type='hidden' name='id_comment' value='".$id_comment."'>
		<input type='hidden' name='date' value='".$date."'>
		<input type='hidden' name='username' value='".$username."'>
		<textarea name='message' rows='3' cols='71'>".$message."</textarea><br>
		<button type='submit' name='commentSubmit'>Edit</button>
	</form>";
	?>
</body>
</html>