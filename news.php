<?php

//conection:
$link = mysqli_connect("localhost","root","","personal_page") or die("Error " . mysqli_error($link));

if (isset($_GET['id']))
{
	$id = $_GET['id'];

	if ($id == '')
	{
		unset($id);
		header("Location: .");
		die();
	}
}

$table_name = "new_article";
$query = "SELECT * FROM $table_name WHERE id = '$id'";

$result = $link->query($query);
 ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Personal-Page</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/normalize.css">
</head>
<body>
	<div class="wrapper command-module">
		<header class="header">
			<!-- <div class="search">Поиск по сайту...</div> -->
			<div class="title-string">indycate</div>
		</header>
		<?php
			while($row = mysqli_fetch_array($result)) {
		?>
		<div class="news_post">
			<h1 class="title-line expand"><?php echo $row["new_article_title"]; ?></h1>
			<div class="news_information">
				<div class="date"><?php echo $row["new_article_date"]; ?></div>
				<div class="category"><?php echo $row["new_article_category"]; ?></div>
			</div>
			<p class="content"><?php echo $row["new_article_text"]; ?></p>
		</div>
		<?php } ?>
		<!-- <div class="footer">Подвал сайта</div> -->
	</div>
	<!-- <script src="./js/main.js"></script> -->
</body>
</html>