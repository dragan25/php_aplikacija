<?php 
require "../config.php";
$conn = Database::getInstance();
	if(!Session::get('username')||Session::get('username')!='admin'){
		header("Location: ./");  
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>uSsportNews</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700,700i" rel="stylesheet">
<link href="../fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
  <header id="header">
	<div id="moto">
	<div class="r"><a href="logout.php">AdminLogOut</a></div>
		<p>US<span id="sp">SPORT</span>News</p>
	</div><!-- end #moto -->
  </header> 
  <nav id="nav">
	<ul>
		<li><a href="./"><i class="fa fa-home fa-fw"></i>&nbsp;Home</a></li>
		<li><a href="?page=1">NBA</a></li>
		<li><a href="?page=2">NFL</a></li>
		<li><a href="?page=3">MLB</a></li>
		<li><a href="?page=4">NHL</a></li>
		<li><a href="?page=5">MLS</a></li>
	</ul>
	<div id="search">
	<form method="GET" action="index.php">
		<input type="hidden" name="page" value="7">
		<input type="text" name="search" placeholder="Search...">
		<button type="submit" name="submit-search">
			<i class="fa fa-search"></i>
		</button>
	</form>
	</div>
	<div id="socialnav">
		<a href="https://www.facebook.com/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
		<a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
		<a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
	</div>	
  </nav> 
  <div id="main">
		<a class="management" href="categories_management.php">Manage Categories</a>
		<a class="management" href="news_management.php">Manage News &amp; Comment Removal</a><br><br><br>
	<?php
		$default_page = (isset($_GET['page']))?$_GET['page']:0;
		$pages = array(
		    "0"=>"news.php",
			"1"=>"nba.php",
			"2"=>"nfl.php",
			"3"=>"mlb.php",
			"4"=>"nhl.php",
			"5"=>"mls.php",
			"6"=>"single_news.php",
			"7"=>"search.php"
		);
		if(isset($pages[$default_page])){           
		include "../modules/" . $pages[$default_page];
		}
	  ?>
	</div> <!-- end of main -->
	<aside id="sidebar">
	  <?php        
		$news = News::getAll();
		foreach($news as $rw) {
		?>
			<div class="side">
				<h4><?php echo $rw->headline; ?></h4>
				<p class="content_side"><?php echo $rw->content; ?></p>
			</div>
			<p class="readmore_side"><a href="?page=6&nid=<?php echo $rw->id_news; ?>">Read more...</a></p>
			<hr class="hrr">
		<?php
		}
		?>
  </aside>
  <footer id="footer">
    <nav>
		<a href="./"><i class="fa fa-home fa-fw"></i>&nbsp;Home</a> |
		<a href="?page=1">NBA</a>|
		<a href="?page=2">NFL</a>|
		<a href="?page=3">MLB</a>|
		<a href="?page=4">NHL</a>|
		<a href="?page=5">MLS</a>
	</nav>
	<hr>
	<div id="social">
		<a href="https://www.facebook.com/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
		<a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
		<a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
	</div>
	<hr>
	<p>Source: my-imagination.inc</p>
  </footer> 
</div>   
<!-- end of wrapper -->
  <button onclick="topFunction()" id="myBtn" title="Go to top">Back on Top</button>
	<script>
	window.onscroll = function() {scrollFunction()};
	function scrollFunction() {
		if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
			document.getElementById("myBtn").style.display = "block";
		} else {
			document.getElementById("myBtn").style.display = "none";
		}
	}
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
  </script> 
  <script>
	
  </script>
</body>
</html>
