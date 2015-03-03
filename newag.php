<?php require_once 'inc/hd.inc';

if ($_POST) {
	# Cuando se registra un nuevo usuario:

	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}
 	$own = $_SESSION['user'];
	require_once 'inc/Usuario.class.php';
	$r = new Usuario($user, $pw, $rol, $nom);
	$existe = $r->check_duplicated();
	if ($existe > 0) {
		print '<script type="text/javascript">';
		print '$(document).ready(function(){';
		print '$("#show").addClass("alert alert-danger");';
		print '$("#show").html("<p>Este usuario ya existe, utiliza un username diferente.</p>");';
		print '});';
		print '</script>';
	} else {
		$r->insert_it();
		header("Location: index.php");
	}
}

if ($_SESSION['rol'] == 'Supervisor') { 
	# Si el usuario es Supervisor, puede agregar usuarios:
	require_once 'inc/nvsup.inc';
	?>

	<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Nuevo usuario</h1>
				</div>
				<div id="show"></div>
				<div class="panel-body">
					<form action="" method="post">
						<div class="row">
							<div class="col-sm-12">
								<input type="text" name="user" placeholder="Username" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="password" name="pw" placeholder="Password" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<label>Rol:</label>
								<select name="rol" class="form-control">
									<option>Agente</option>
									<option>Supervisor</option>
								</select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" name="nom" placeholder="Nombre y apellido" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="submit" class="btn btn-success" value="Agregar" class="form-control">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
} else {
	# Si el usuario no es Supervisor, no puede agregar usuarios.
	print 'Tu no puedes... Tu rol es: ' . $_SESSION['rol'] . '... :(';
} ?>

<?php require_once 'inc/ft.inc'; ?>