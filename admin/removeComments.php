<?php
Session::start();
ob_start();
function getComments($conn){
	if(isset($_GET['nid'])){
		$sql = "select * from comments where id_news = {$_GET['nid']}";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()){
			$username = $row['username'];
			$sql2 = "SELECT * FROM users WHERE username='$username'";
			$result2 = mysqli_query($conn, $sql2);
			if($row2 = $result2->fetch_assoc()){
				echo "<div style='border:1px solid #777;width:505px;padding-left:15px;margin:2px 0px;'><p><span style='font-size:0.7em;'>";
				echo $row['date']."</span><br><b>";
				echo $row2['username']."</b><br>";
				echo nl2br($row['message']);
				echo "</p>";
				echo
				"<form method='POST' action='".deleteComments($conn)."'>
					<input type='hidden' name='id_comment' value='".$row['id_comment']."'>
					<button type='submit' name='commentDelete'>Delete</button>
				</form>";
				echo "</div>";
			}
		}
	}	
}
function deleteComments($conn) {
	if(isset($_POST['commentDelete'])){
		$id_comment = $_POST['id_comment'];
		$sql = "delete from comments where id_comment='$id_comment'";
		$result = mysqli_query($conn, $sql);
		header("Location: news_management.php");
	}
}	
	
	
	