<?php 
require "../config.php";
date_default_timezone_set('Europe/Copenhagen');
include "removeComments.php";
if(!Session::get('username')||Session::get('username')!='admin'){
	header("Location: index.html");  
}
$conn = Database::getInstance();
$selected_id = -1;
$selected_date = "0000-00-00 00:00:00";
$selected_headline = "";
$selected_content = "";
$selected_image = "";
$selected_category = 0;   // 0 a ne "" jer je u bazi ova kolona integer
$selected_title = "";
$selected_author = "";

if(isset($_GET['nid'])) {
	$q = mysqli_query($conn, "select news.id_news, news.date, news.headline, news.content, images.image, images.title, images.author,
	categories.id_category from news join images on news.id_image = images.id_image join categories
	on news.id_category = categories.id_category where id_news = {$_GET['nid']}");
	$rw = mysqli_fetch_object($q);     // fetchovanje je citanje redova iz tabele koju tretiramo queryjem
	if($rw){
	$selected_id = $rw->id_news;
	$selected_date = $rw->date;
	$selected_headline = $rw->headline;
	$selected_content = $rw->content;
	$selected_image = $rw->image;
	$selected_category = $rw->id_category;
	$selected_title = $rw->title;
	$selected_author = $rw->author;
	}
}
if(isset($_POST['btn_insert'])) {
	$selected_headline = $_POST['tb_headline'];   // paremetri su imena input polja
	$selected_date = $_POST['tb_date'];
	$selected_content = $_POST['tb_content'];
	$selected_category = $_POST['sel_category'];
	$selected_image = $_POST['tb_url_image'];     // sama slika
	$selected_title = $_POST['tb_title'];
	$selected_author = $_POST['tb_author'];
	mysqli_query($conn, "insert into images values (null, '{$selected_title}', '{$selected_image}', '{$selected_author}')");
	$selected_id = mysqli_insert_id($conn);       // id samog unosa dodjeljuje se funkcijom jer je u upitu null (AI)
	$selected_id_image = mysqli_insert_id($conn); // id slike se dodjeljuje funkcijom jer je u upitu null (AI)
	mysqli_query($conn, "insert into news values (null, '{$selected_date}', '{$selected_headline}', '{$selected_content}', '{$selected_category}', '{$selected_id_image}')");
}
if(isset($_POST['btn_update'])) {
	$selected_headline = $_POST['tb_headline'];
	$selected_date = $_POST['tb_date'];
	$selected_content = $_POST['tb_content'];
	$selected_category = $_POST['sel_category'];
	$selected_id = $_POST['selNews'];
	$selected_image = $_POST['tb_url_image'];
	$selected_title = $_POST['tb_title'];
	$selected_author = $_POST['tb_author'];
	mysqli_query($conn, "update news set date='{$selected_date}', headline='{$selected_headline}', content='{$selected_content}', id_category = {$selected_category} where id_news = {$selected_id}");
	mysqli_query($conn, "update images set image = '{$selected_image}', author = '{$selected_author}' where title = '{$selected_title}'");
}
if(isset($_POST['btn_delete'])) {
	$selected_id = $_POST['selNews'];
	$selected_title = $_POST['tb_title'];
	mysqli_query($conn, "delete from news where id_news = {$selected_id}");
	mysqli_query($conn, "delete from images where title = '{$selected_title}'");
}	
?>
<form method="post" action="" enctype="multipart/form-data">
<select onchange="window.location='?nid='+this.value" name="selNews">  <!-- malo js-a konkat i upotreba this (sto se odnosi na select tag) -->
<option value="-1">Select News</option>
<?php 
$q = mysqli_query($conn, "select * from news");
?>
<?php 
while($rw=mysqli_fetch_object($q)){
	echo "<option " . ($selected_id==$rw->id_news?"selected":"") . " value='{$rw->id_news}'>{$rw->headline}</option>";
}
?>
</select>
<br>
<input type="text" name="tb_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
<br>
Headline:<br>
<input type="text" name="tb_headline" value="<?php echo $selected_headline; ?>" size="77">
<br>
Content:<br>
<textarea rows="10" cols="71" name="tb_content"><?php echo $selected_content; ?></textarea>
<br>
Category:<br>
<?php 
$q = mysqli_query($conn, "select * from categories");
?>
<select name="sel_category">  
<option value="-1">Select category</option>
<?php 
while($rw=mysqli_fetch_object($q)){
	echo "<option " . ($selected_category==$rw->id_category?"selected":"") . " value='{$rw->id_category}'>{$rw->name}</option>";
}
?>
</select>
<br>
Image:
<br>
<img src="<?php echo $selected_image; ?>" height="150">
<br>
<!-- ako bi slucajno bilo sto od unosa sadrzavalo (') ispred njega staviti \ (\') -->
Title: <br><input type="text" name="tb_title" value="<?php echo $selected_title; ?>" size="77">
<br>
Author: <br><input type="text" name="tb_author" value="<?php echo $selected_author; ?>" size="77">
<br>
URL: <br><input type="text" name="tb_url_image" value="<?php echo $selected_image; ?>" size="77">
<br><br>
<input type="submit" name="btn_insert" value="Add new">
<input type="submit" name="btn_update" value="Update">
<input type="submit" name="btn_delete" value="Delete">
</form>
<br><br>
<a href="index.php">Back to AdminPage</a>
<hr>
<p><b><u>Remove Inappropriate Comments:</u></b></p>
<div>
<?php getComments($conn); ?>
</div>
<br><br>
<a href="index.php">Back to AdminPage</a>








