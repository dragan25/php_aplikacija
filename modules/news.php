<?php
$category = isset($_GET['page'])&&is_numeric($_GET['page'])?$_GET['page']:0;        //sa 0 podrazumjevanu stranu smo promjenili smo na 0
$news = News::getAll();
?>
<h1>Latest News from US National Leagues</h1>
<?php
foreach($news as $rw) {
?>
	<div class="news">
			<figure>
				<a href="?page=6&nid=<?php echo $rw->id_news; ?>">
				<img src="<?php echo $rw->image; ?>" alt="image"></a>
				<figcaption>
				</figcaption>
			</figure>
			<h3><a href="?page=6&nid=<?php echo $rw->id_news; ?>"><?php echo $rw->headline; ?></a></h3>
			<p class="date"><?php echo $rw->date; ?></p>
			<p class="content"><?php echo nl2br($rw->content); ?></p>
		<p class="readmore"><a href="?page=6&nid=<?php echo $rw->id_news; ?>">Read more...</a></p>
	</div>
<?php
}
?>



 