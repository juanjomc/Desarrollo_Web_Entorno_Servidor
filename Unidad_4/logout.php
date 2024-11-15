<?php
//Cierro la sesion y redirijo al usuario al pagina principal
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit();
?>