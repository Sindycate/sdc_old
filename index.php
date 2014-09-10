<?php

session_start();
//conection:
$link = mysqli_connect("localhost","root","","personal_page") or die("Error " . mysqli_error($link));

//consultation:
$table_name = "new_article";
$query = "SELECT * FROM $table_name ORDER BY `new_article_date`";

//execute the query.

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
			<?php
			// Проверяем, пусты ли переменные логина и id пользователя
			if (empty($_SESSION['login']) or empty($_SESSION['id']))
			{
				?>
				<form action="sign_in.php" method="post">
					<div class="authorization">
						<input name="login" type="text" placeholder="login" />
						<input name="password" type="password" placeholder="password" />
						<input class="Sign_in" type="submit" value="Войти">
						<a href = "registration.html">Зарегестрироваться</a>
					</div>
				</form>
				<?php
				/*echo "Вы вошли на сайт, как гость.<br>";*/
			}
			else
			{
				?>
				<div class="authorization">
					<div class="uvedomlenie">
					<?php
					echo "Вы вошли на сайт, как ".$_SESSION['login'].".";
					?>
					<a href="./endsession.php">Exit</a>
					</div>
				</div>
				<?php
			}
			?>

			<div class="title-string">indycate</div>
		</header>
		<div class="main-colum-left">
			<div class="left-sidebar">
				<ul class="section">
					<li><a href="#">Новое</a></li>
					<li><a href="#">Всё</a></li>
					<li><a href="#">По категориям</a>
						<ul>
							<li><a href="#">Заметки</a></li>
							<li><a href="#">Книги</a></li>
							<li><a href="#">Наука</a></li>
							<li><a href="#">Другое</a></li>
						</ul>
					</li>
					<li><a href="#">Дополнительно</a></li>
				</ul>
			</div>
			<?php
				if ((!empty($_SESSION['id'])) && ($_SESSION['permission'] == "admin")) {
			?>
					<a href = "new_article.html"><input class="addArticle" type="submit" value="Добавить новость"></a>
			<?php
				}
			?>
		</div>
		<div class="news-block">
			<?php
				while($row = mysqli_fetch_array($result)) {
			?>
			<div class="post">
				<h1 class="title-line expand"><a href="./news.php?id=<?php echo $row["id"]; ?>"><?php echo $row["new_article_title"]; ?></a></h1>
				<div class="information">
					<div class="date"><?php echo $row["new_article_date"]; ?></div>
					<div class="category"><?php echo $row["new_article_category"]; ?></div>
				</div>
				<p class="content"><?php echo $row["new_article_text"]; ?></p>
			</div>
			<a href="./news.php?id=<?php echo $row["id"]; ?>" class="read-full expand">Читать полностью</a>
			<?php } ?>
		</div>
		<!-- <div class="footer">Подвал сайта</div> -->
	</div>
	<script src="./js/main.js"></script>
</body>
</html>
