<?php
require_once 'inc/hdwm.inc';

# Edicion de usuarios
##################
if (isset($_POST['eusername'])) {

	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}

	//var_dump($_POST);
	require_once 'inc/Usuario.class.php';
	$r = new Usuario($eusername, $epw, $erol, $ename);
	$r->update();
}
# /Edicion de usuarios
###################

# Desactivar usuarios
#################
if (isset($_POST['disablethis'])) {

	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}
	//echo $deletethis;
	require_once 'inc/Query.class.php';
	$sqldisable =  "UPDATE refe_user SET user_active='N' WHERE user_username='$disablethis';";
	$dd = new Query($sqldisable);
	$dd->exec_query();
}
#################
# /Desactivar usuarios

# Activar usuarios
#################
if (isset($_POST['enablethis'])) {

	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}
	//echo $deletethis;
	require_once 'inc/Query.class.php';
	$sqlenable =  "UPDATE refe_user SET user_active='Y' WHERE user_username='$enablethis';";
	$e = new Query($sqlenable);
	$e->exec_query();
}
#################
# /Activar usuarios

# Eliminar usuarios
#################
if (isset($_POST['deletethis'])) {

	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}
	//echo $deletethis;
	require_once 'inc/Query.class.php';
	$sqldel =  "DELETE FROM refe_user WHERE user_username='$deletethis';";
	$d = new Query($sqldel);
	$d->exec_query();
}
#################
# /Eliminar usuarios

# Comprobar que el usuario sea un supervisor
if ($_SESSION['rol'] == 'Supervisor') {
	# Entonces puede ver la pantalla:
	require_once 'inc/nvsup.inc';
	# Sql that get all the data from the users:
	$sqlusers = "SELECT user_username, user_pass, user_rol, user_name, user_active FROM refe_user;";
	require_once 'inc/Query.class.php';
	$qusers = new Query($sqlusers);
	$usersdata = $qusers->query_array_assoc();
	?>

	<div class="container">
		<?php
		## Now we creating the cards for the users and then create the modal for edit the info of the selected user
		for ($i=0; $i < count($usersdata); $i++) { 

			# PANEL DE INFORMACION
			#######################
			print '<row class="col-sm-3">';
			if ($usersdata[$i]['user_active'] == 'Y') {
				print '<div class="panel panel-success">';
			} elseif ($usersdata[$i]['user_active'] == 'N'){
				print '<div class="panel panel-warning">';
			}
			print '<div class="panel-heading">';
			print '<h3 class="panel-title"><b>' . $usersdata[$i]['user_name'] . '</b></h3>';
			print '</div>';
			print '<div class="panel-body">';
			print 'Username: ' . $usersdata[$i]['user_username'];
			print '<br>';
			print 'Nombre: ' . $usersdata[$i]['user_name'];
			print '<br>';
			print 'Rol de usuario: ' . $usersdata[$i]['user_rol'];
			print '</div>';
			print '<div class="panel-footer">';
			print '<a href="#" data-toggle="modal" data-target=".' . $usersdata[$i]['user_username'] . '"><i class="fa fa-pencil-square-o"></i> Editar</a>&nbsp;&nbsp;';
			if ($_SESSION['user'] != $usersdata[$i]['user_username']) {
				if ($usersdata[$i]['user_active'] == 'Y') {
					# Si el usuario esta activo, entonces mostrar desactivar
					print '<a href="#" data-toggle="modal" data-target=".dd' . $usersdata[$i]['user_username'] . '"><i class="fa fa-thumbs-o-down"></i> Desactivar</a>&nbsp;&nbsp;';
				} elseif ($usersdata[$i]['user_active'] == 'N') {
					# Si el usuario esta desactivo, entonces mostrar activar
					print '<a href="#" data-toggle="modal" data-target=".e' . $usersdata[$i]['user_username'] . '"><i class="fa fa-thumbs-o-up"></i> Activar</a>&nbsp;&nbsp;';
				}
				print '<a href="#" data-toggle="modal" data-target=".d' . $usersdata[$i]['user_username'] . '"><i class="fa fa-trash-o"></i> Eliminar</a>';
			}
			print '</div>';
			print '</div>';
			print '</row>';
			########################
			# /PANEL DE INFORMACION

			########################
			# POPUP EDITAR USUARIOS

			print '<div class="modal fade ' . $usersdata[$i]['user_username'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
			print '<div class="modal-dialog modal-sm">';
			print '<div class="modal-content">';
			print '<div class="modal-header">';
			print '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			print '<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>';
			print '</div>';
			print '<div class="modal-body">';
			
			#Aqui va todos los datos
			print '<form action="" method="post"';
			print '<label>Username: </label><input name="eusername" type="hidden" value="' . $usersdata[$i]['user_username'] . '">';
			print '<label>Nombre: </label><input name="ename" type="text" class="form-control" value="' . $usersdata[$i]['user_name'] . '">';
			print '<label>Rol: </label><select name="erol" class="form-control"><option>'.$usersdata[$i]['user_rol'].'</option><option>Agente</option><option>Supervisor</option></select>';
			print '<label>Password: </label><input name="epw" type="password" class="form-control" value="' . $usersdata[$i]['user_pass'] . '">';
			
			print '</div>';
			print '<div class="modal-footer">';
			print '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
			print '<button type="submit" class="btn btn-primary">Guardar cambios</button>';
			print '</form>';
			print '</div>';
			print '</div>';
			print '</div>';
			print '</div>';
			#########################
			# /POPUP EDITAR USUARIOS

			# POPUP DESACTIVAR USUARIOS
			##########################
			print '<div class="modal fade dd' . $usersdata[$i]['user_username'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
			print '<div class="modal-dialog modal-sm">';
			print '<div class="modal-content">';
			print '<div class="modal-header">';
			print '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			print '<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>';
			print '</div>';
			print '<div class="modal-body">';

			#Data Desactivar
			print '<div class="alert alert-warning" role="alert">';
			print '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
			print '<span class="sr-only">Error:</span>';
			print ' Desea desactivar a <b>' . $usersdata[$i]['user_username'] . '</b>';
			print '</div>';

			print '</div>';
			print '<form action="" method="post">';
			print '<input type="hidden" name="disablethis" value="' . $usersdata[$i]['user_username'] . '">';
			print '<div class="modal-footer">';
			print '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
			print '<button type="submit" class="btn btn-warning">Si</button>';
			print '</form>';
			print '</div>';
			print '</div>';
			print '</div>';
			print '</div>';
			###########################
			# /POPUP DESACTIVAR USUARIOS

			# POPUP ACTIVAR USUARIOS
			##########################
			print '<div class="modal fade e' . $usersdata[$i]['user_username'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
			print '<div class="modal-dialog modal-sm">';
			print '<div class="modal-content">';
			print '<div class="modal-header">';
			print '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			print '<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>';
			print '</div>';
			print '<div class="modal-body">';

			#Data Activar
			print '<div class="alert alert-success" role="alert">';
			print '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
			print '<span class="sr-only">Error:</span>';
			print ' Desea activar a <b>' . $usersdata[$i]['user_username'] . '</b>';
			print '</div>';

			print '</div>';
			print '<form action="" method="post">';
			print '<input type="hidden" name="enablethis" value="' . $usersdata[$i]['user_username'] . '">';
			print '<div class="modal-footer">';
			print '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
			print '<button type="submit" class="btn btn-success">Si</button>';
			print '</form>';
			print '</div>';
			print '</div>';
			print '</div>';
			print '</div>';
			###########################
			# /POPUP ACTIVAR USUARIOS

			# POPUP ELIMINAR USUARIOS
			##########################
			print '<div class="modal fade d' . $usersdata[$i]['user_username'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
			print '<div class="modal-dialog modal-sm">';
			print '<div class="modal-content">';
			print '<div class="modal-header">';
			print '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			print '<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>';
			print '</div>';
			print '<div class="modal-body">';

			#Data eliminar
			print '<div class="alert alert-danger" role="alert">';
			print '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
			print '<span class="sr-only">Error:</span>';
			print ' Esta seguro de eliminar a <b>' . $usersdata[$i]['user_username'] . '</b>';
			print '</div>';

			print '</div>';
			print '<form action="" method="post">';
			print '<input type="hidden" name="deletethis" value="' . $usersdata[$i]['user_username'] . '">';
			print '<div class="modal-footer">';
			print '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
			print '<button type="submit" class="btn btn-danger">Si</button>';
			print '</form>';
			print '</div>';
			print '</div>';
			print '</div>';
			print '</div>';
			###########################
			# /POPUP ELIMINAR USUARIOS
		}
		?>
	</div>

	<?php

} else {
	# Si el usuario no es Supervisor, no puede administrar usuarios. 
	print 'Tu no puedes... Tu rol es: ' . $_SESSION['rol'] . '... :(';
}

?>

<?php require_once 'inc/ft.inc'; ?>