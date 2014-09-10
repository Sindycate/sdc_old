<?php

//заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['newArticle_title']))
{
    $title = $_POST['newArticle_title'];

    if ($title == '')
    {
        unset($title);
    }
}

//заносим введённый пользоватлем пароль в переменную password, также проверяем на заполненность
if (isset($_POST['newArticle_date']))
{
    $date=$_POST['newArticle_date'];

    if ($date =='')
    {
        unset($date);
    }
}

if (isset($_POST['newArticle_category']))
{
    $category=$_POST['newArticle_category'];

    if ($category =='')
    {
        unset($category);
    }
}

if (isset($_POST['newArticle_text']))
{
    $text=$_POST['newArticle_text'];

    if ($text =='')
    {
        unset($text);
    }
}

//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
if (empty($title) || empty($date) || empty($category) || empty($text))
{
	echo ("Вы ввели не всю информацию, вернитесь назад и заполните все поля.");
	?>
	<a href = "new_article.html"><button type="submit" class="btn btn-mini btn-s">Home</button></a>
	<?php
	exit();
}

include ("./db.php");
// проверка на существование пользователя с таким же логином
$result = mysql_query("SELECT id FROM new_article WHERE new_article_title ='$title'",$db); //mysql_query — Посылает запрос MySQL;
$myrow = @mysql_fetch_array($result); //возратит нам данные в виде ассоциативного массива;

if (!empty($myrow['id']))
{
    echo ("Извините, введённый вами заголовок уже существует, введите другой.");
    ?>
    <a href = "save_new_article.php"><button type="submit" class="btn btn-mini btn-s">Home</button></a>
    <?php
    exit();
}
// если такого нет, то сохраняем данные

$result2 = mysql_query("INSERT INTO new_article (new_article_title, new_article_date, new_article_category, new_article_text) VALUES('$title','$date', '$category', '$text')");
// Проверяем, есть ли ошибки
if ($result2 == 'TRUE')
{
    header('Location: .');
    /*echo " Статья успешно сохранена. <a href='index.php'>Главная страница</a>";*/
}
else
{
    echo "Ошибка! Статья не была сохранена.";
    ?>
    <a href = "index.php"><button type="submit" class="btn btn-mini btn-s">Home</button></a>
    <?php
}

?>