<?php

session_start();

if (isset($_POST['new_login']))
{
    $login = $_POST['new_login'];

    if ($login == '')
    {
        unset($login);
    }
}

if (isset($_POST['new_password']))
{
    $password=$_POST['new_password'];

    if ($password =='')
    {
        unset($password);
    }
}

if (empty($login) || empty($password)) {
    echo ("Вы не ввели логин или пароль, вернитесь назад.");
    ?>
    <a href = "registration.html"><button type="submit" class="btn btn-mini btn-s">Назад к регистрации</button></a>
    <?php
    exit();
}

include ("./db.php");

$result = mysql_query("SELECT id FROM users WHERE user_login ='$login'",$db);
$myrow = @mysql_fetch_array($result);

if (!empty($myrow['id']))
{
    echo ("Извините, введённый вами логин уже существует, введите другой.");
    ?>
    <a href = "registration.html"><button type="submit" class="btn btn-mini btn-s">Назад к регистрации</button></a>
    <?php
    exit();
}

$result2 = mysql_query("INSERT INTO users (user_login, user_password) VALUES('$login','$password')");

if ($result2 == 'TRUE')
{
    header('Location: .');
/*    echo " Вы успешно добавлены <a href='index.php'>Главная страница</a>";*/
}
else
{
    echo "Ошибка! Пользователь не был добавлен.";
    ?>
    <a href = "index.php"><button type="submit" class="btn btn-mini btn-s">Home</button></a>
    <?php
}

?>