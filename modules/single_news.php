<?php 
include "comments.php";
date_default_timezone_set('Europe/Copenhagen');
$id_news = isset($_GET['nid'])&&is_numeric($_GET['nid'])?$_GET['nid']:0;   
$news = News::getOneN($id_news);
if(!$news){
	echo "News does not exists!";
} else {
?>
<div class="single_news">
	<h2><?php echo $news->headline; ?></h2>
	<p class="date"><i><b>Published:</b> <?php echo $news->date; ?></i></p>
	<figure>
	<img src="<?php echo $news->image; ?>" alt="image">
	<figcaption><i><?php echo $news->author; ?></i></figcaption>
	</figure>
	<p><?php echo nl2br($news->content); ?></p>
</div>
<br><br><hr>
<?php 
}
?>
<?php
if(isset($_SESSION['username'])){  
	echo 
	"<form method='POST' action='".setComments($conn)."'>
		<input type='hidden' name='username' value='".$_SESSION['username']."'>
		<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
		<input type='hidden' name='id_news' value='".$id_news."'>
		<textarea name='message' rows='3' cols='71'></textarea><br>
		<button type='submit' name='commentSubmit'>Comment</button>
	</form>";
} else {
	echo "<a href='user_login/index.html'>Log in to leave comment!</a><br><br>";
}
getComments($conn);
?>