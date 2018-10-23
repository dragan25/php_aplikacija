<?php
ob_start();
function setComments($conn){
	if(isset($_POST['commentSubmit'])){
		$date = $_POST['date'];
		$username = $_POST['username'];
		$id_n = $_POST['id_news'];                    // varijabla za id_news iz komentara
		$message = $_POST['message'];
		$sql = "insert into comments values (null, '{$date}','{$username}','{$message}','{$id_n}')";
		$result = mysqli_query($conn, $sql);
        $_SESSION['message'] = 'Operation Done';
		$sql2 = "select id_news from news";
		$result2 = mysqli_query($conn, $sql2);
		
		while($row = $result2->fetch_assoc()) {   
			foreach($row as $key => $id_news){
			$row[$key]=$id_news;                      // varijabla za id_news iz vijesti
			header("Location: ?page=6&nid=$id_n");
			} 		
		}
        exit;
    }
}
function getComments($conn){
	if(isset($_GET['nid'])){
		$sql = "select * from comments where id_news = {$_GET['nid']}";
		$result = mysqli_query($conn, $sql);
		while($row = $result->fetch_assoc()){
			$username = $row['username'];
			$sql2 = "SELECT * FROM users WHERE username='$username'";
			$result2 = mysqli_query($conn, $sql2);
			if($row2 = $result2->fetch_assoc()){
				echo "<div class='comment-boxes'><p><span class='date_comment'>";
				echo $row['date']."</span><br><span class='username_comment'>";
				echo $row2['username']."</span><br>";
				echo nl2br($row['message']);
				echo "</p>";
				if(isset($_SESSION['username'])){
					if($_SESSION['username'] == $row2['username']){
						echo
						"<form method='POST' action='".deleteComments($conn)."' class='del_edit_comment'>
							<input type='hidden' name='id_comment' value='".$row['id_comment']."'>
							<button type='submit' name='commentDelete'>Delete</button>
						</form>
						<form method='POST' action='editcomment.php' class='del_edit_comment'>
							<input type='hidden' name='id_comment' value='".$row['id_comment']."'>
							<input type='hidden' name='date' value='".$row['date']."'>
							<input type='hidden' name='username' value='".$row['username']."'>
							<input type='hidden' name='message' value='".$row['message']."'>
							<button>Edit</button>
						</form>";
					} 
				} 
				echo "</div>";
			}
		}
	}	
}
function editComments($conn){    
	if(isset($_POST['commentSubmit'])){
		$id_comment = $_POST['id_comment'];
		$date = $_POST['date'];
		$username = $_POST['username'];
		$message = $_POST['message'];
		$sql = "UPDATE comments SET message='$message' WHERE id_comment='$id_comment'";
		$result = mysqli_query($conn, $sql);
		header("Location: index.php");
	}
}
function deleteComments($conn) {
	if(isset($_POST['commentDelete'])){
		$id_comment = $_POST['id_comment'];
		$sql = "delete from comments where id_comment='$id_comment'";
		$result = mysqli_query($conn, $sql);
		header("Location: ./");
	}
}	
	
	
	