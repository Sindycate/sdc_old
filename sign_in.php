<?php

session_start();

if (isset($_POST['login']))
{ $login = $_POST['login'];
    if ($login == '')
    {
        unset($login);
    }
}

if (isset($_POST['password']))
{
    $password=$_POST['password'];
    if ($password =='')
    {
        unset($password);
    }
}

if (empty($login) or empty($password))
{
    echo ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    ?>
    <a href = "index.php"><button type="submit" class="btn btn-mini btn-s">Home</button></a>
    <?php
    exit();
}
//обрабатываем полученные данные
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);

//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);

include ("./db.php");

$result = mysql_query("SELECT * FROM users WHERE user_login ='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysql_fetch_array($result);

if (empty($myrow['user_login']))
{
    //если пользователя с введенным логином не существует
    echo ("Извините, введённый вами login или пароль неверный.");
    ?>
    <a href = "index.php"><button type="submit" class="btn btn-mini btn-s">Home</button></a>
    <?php
    exit();
}
else
{
    //если существует, то сверяем пароли
    if ($myrow['user_password']==$password)
    {
        //если пароли совпадают, то запускаем пользователю сессию.
        $_SESSION['login']      = $myrow['user_login'];
        $_SESSION['id']         = $myrow['id'];
        $_SESSION['permission'] = $myrow['permission'];
        //эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
        header('Location: .');
        /*echo "Вы успешно вошли на сайт! <a href='index.php'>Главная страница</a>";*/
    }
    else
    {
        //если пароли не сошлись
        echo ("Извините, введённый вами login или пароль неверный.");
        ?>
        <a href = "index.php"><button type="submit" class="btn btn-mini btn-s">Home</button></a>
        <?php
        exit();
    }
}

?>