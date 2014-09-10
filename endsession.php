<?php

@session_start();
session_destroy();
header('Location: .');
/*echo("Вы вышли из профиля.");*/

?>

