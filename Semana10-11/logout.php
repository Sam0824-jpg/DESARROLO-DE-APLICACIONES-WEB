<?php
session_start();
$_SESSION = array(); // Vaciar todas las variables de sesión
session_destroy(); // Destruir la sesión actual en el servidor
header("Location: login.php");
exit();
?>