<?php 
require "../config.php";
if(!Session::get('username')||Session::get('username')!='admin'){
	header("Location: index.html");  
}
$selectedCategory = new Category;   // dummy  objekt (jedna kategorija)
if(isset($_GET['cid'])) {
	$selectedCategory = Category::getOneC($_GET['cid']);
}
if(isset($_POST['btn_insert'])) {
	$selectedCategory = new Category;
	$selectedCategory->name = $_POST['tb_name'];
	$selectedCategory->description = $_POST['tb_description'];
	$selectedCategory->insert();
}	
if(isset($_POST['btn_update'])) {
	$selectedCategory = Category::getOneC($_POST['selCategory']);
	$selectedCategory->name = $_POST['tb_name'];
	$selectedCategory->description = $_POST['tb_description'];
	$selectedCategory->save();
}
if(isset($_POST['btn_delete'])) {
	$name = $_POST['tb_name'];
	$selectedCategory->deleteC($name);
}	
?>
<form method="post" action="">
<?php 
$categories = Category::getAll();
?>
<select onchange="if(this.value<0) return; window.location='?cid='+this.value" name="selCategory">  <!-- malo js-a -->
<option value="-1">Select category</option>
<?php 
foreach($categories as $rw){
	echo "<option " . ($selectedCategory->id_category==$rw->id_category?"selected":"") . " value='{$rw->id_category}'>{$rw->name}</option>";
}
?>
</select>
<br>
Name:<br>
<input type="text" name="tb_name" value="<?php echo $selectedCategory->name; ?>">
<br>
Description:<br>
<input type="text" name="tb_description" value="<?php echo $selectedCategory->description; ?>">
<br><br>
<input type="submit" name="btn_insert" value="Add new">
<input type="submit" name="btn_update" value="Update">
<input type="submit" name="btn_delete" value="Delete">
</form>
<br>
<a href="index.php">Back to AdminPage</a>