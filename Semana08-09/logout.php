<?php
session_start();
$_SESSION = array(); // Vaciar las variables
session_destroy(); // Destruir la sesión en el servidor
header("Location: login.php");
exit();
?>