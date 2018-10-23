<h2>Search Page</h2>
<div>
<?php
	if(isset($_GET['submit-search'])){
		$search = mysqli_real_escape_string($conn, $_GET['search']);
		$sql = "SELECT * FROM news WHERE headline LIKE '%$search%' OR content LIKE '%$search%' ORDER BY date DESC";
		$result = mysqli_query($conn, $sql);
		$queryResult = mysqli_num_rows($result);
		if($queryResult > 0){
			while($row = $result->fetch_assoc()){
				echo "<div class='news'>
					<h3>".$row['headline']."</h3>
					<p class='date'>".$row['date']."</p>
					<p class='content'>".$row['content']."</p>
					<p class='readmore'><a href='?page=6&nid=".$row['id_news']."'>Read more...</a></p>
				</div>";
			}
		} else {
			echo "There are no results matching your search!";
		}
	}
?>
</div>