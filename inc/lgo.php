<?php
session_start();
// quita todas las variables de session
session_unset();
// destruye la session
session_destroy();
header('Location: ../index.php');
?>