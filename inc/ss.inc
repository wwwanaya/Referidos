<?php
session_start();
if(!isset($_SESSION['user'])){
	/*echo 'Bienvenido ' . $_SESSION['user'] . '. ';
	echo '<a href="inc/lgo.php">Logout</a>';*/
	header('Location: login.php');
}
?>