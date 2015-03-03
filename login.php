<?php
require_once 'inc/hd2.inc';
session_start();
//var_dump($_POST);
if($_POST){

	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}

	$pw = hash("whirlpool", $pass);
	$prfx = md5('$%');
	$pwtoDB = hash("sha512", $prfx.$pw);

	$sql = "SELECT user_username, user_pass, user_name FROM refe_user WHERE user_username='$user' AND user_pass='$pwtoDB' LIMIT 1;";
	require_once 'inc/Query.class.php';
	$q = new Query($sql);
	if($q->query_numrows() == 1){
		$sql2 = "SELECT user_username, user_pass, user_name FROM refe_user WHERE user_username='$user' AND user_pass='$pwtoDB' AND user_active='Y' LIMIT 1;";
		$q2 = new Query($sql2);
		if ($q2->query_numrows() == 1) {
			# Creo la session
			echo 'login ok';
			$user = $q->query_array();
			$username = $user[0]['user_username'];
			//var_dump($user);
			$sql2 = "SELECT user_rol FROM refe_user WHERE user_username='$username' LIMIT 1;";
			$q = new Query($sql2);
			$userRol = $q->query_array();
			$rol = $userRol[0]['user_rol'];
			$name = $user[0]['user_name'];
			$_SESSION['user'] = $username;
			$_SESSION['rol'] = $rol;
			$_SESSION['name'] = $name;
		} else {
			echo 'Usuario desactivado';
		}
	} else {
		echo 'Usuario o password incorrecto';
	}

}
if(isset($_SESSION['user'])){
	//echo 'Bienvenido ' . $_SESSION['user'] . '.';
	header('Location: index.php');
}
?>


<div class="container">

<form class="form-signin" action="" method="post">
	<h2 class="form-signin-heading">Iniciar sesión</h2>
	<label for="inputEmail" class="sr-only">Usuario</label>
	<input name="user" id="inputEmail" class="form-control" placeholder="Usuario" type="text">
	<label for="inputPassword" class="sr-only">Password</label>
	<input name="pass" id="inputPassword" class="form-control" placeholder="Password" type="password">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
</form>

</div>

<?php include_once 'inc/ft.inc'; ?>