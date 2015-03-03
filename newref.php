<?php require_once 'inc/hd.inc';?>
<?php
if(isset($_POST['nom'])){

	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}

	if (isset($_POST['assignto'])) {
		$own = $_POST['assignto'];
	} else {
		$own = $_SESSION['user'];
	}

	require_once 'inc/Referido.class.php';
	$r = new Referido($own, $nom, $ape, $tel1, $tel2, $tel3, $who, $status, $obs);
	$existe = $r->check_duplicated();
	if ($existe > 0) {
		//echo "Existe es: " . $existe . ". ";
		print '<script type="text/javascript">';
		print '$(document).ready(function(){';
		print '$("#show").addClass("alert alert-danger");';
		print '$("#show").html("<p>Este referido ya existe.</p>");';
		print '});';
		print '</script>';
		//header('Location: index.php');
	} else {
		//echo "Existe es: " . $existe . ". La meti. ";
		$r->insert_it();
		header("Location: index.php");
	}
}

$sqlstado = "SELECT sta_titulo FROM tbl_status;";
require_once 'inc/Query.class.php';
$qstado = new Query($sqlstado);
$stadodata = $qstado->query_array_assoc();

###############
# NAV BAR SUP #
###############
if ($_SESSION['rol'] == 'Supervisor') {
	require_once 'inc/nvsup.inc';
	// Also I'm including the function to make the supervisor able to add some ref to especific agent.
	#sql for agent list:
	$sqlagnts = "SELECT user_name, user_username FROM refe_user WHERE user_active='Y';";
	require_once 'inc/Query.class.php';
	$qagnts = new Query($sqlagnts);
	$agntsdata = $qagnts->query_array_assoc();
}
################
# /NAV BAR SUP #
################

##############
# NAV BAR AG #
##############
if ($_SESSION['rol'] == 'Agente') {
	require_once 'inc/nvag.inc';
}
###############
# /NAV BAR AG #
###############

?>
<link rel="stylesheet" href="css/nrefval.css">
<script type="text/javascript" src="js/onlynumber.min.js"></script>
<script type="text/javascript" src="js/nrefval.js"></script>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Nuevo referido</h1>
				</div>
				<div id="show"></div>
				<div class="panel-body">
					<form action="" method="post">
						<div class="row">
							<div id="divnom" class="col-sm-12">
								<input type="text" id="nom" name="nom" placeholder="Nombre" class="form-control" data-placement="top">
							</div>
						</div>
						<br>
						<div class="row">
							<div id="divape" class="col-sm-12">
								<input type="text" id="ape" name="ape" placeholder="Apellido" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div id="divtel1" class="col-sm-12">
								<input type="text" id="tel1" name="tel1" placeholder="Tel. Celular" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" id="tel2" name="tel2" placeholder="Tel. Empresa" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" id="tel3" name="tel3" placeholder="Tel. Casa" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" name="who" placeholder="Quien lo refirio" class="form-control">
							</div>
						</div>
						<br>
						<?php
						###################
						# ASSIGN TO AGENT #
						###################
						if ($_SESSION['rol'] == 'Supervisor') {
							?>
							<div class="row">
							<div class="col-sm-12">
								<label>Asignar a:</label>
								<select name="assignto" class="form-control">
									<?php
									for ($i=0; $i < count($agntsdata); $i++) { 
										print '<option value="' . $agntsdata[$i]['user_username'] . '">' . $agntsdata[$i]['user_name'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<br>
							<?php
						}
						####################
						# /ASSIGN TO AGENT #
						####################
						?>
						<div class="row">
							<div class="col-sm-12">
								<label>Estado:</label>
								<select name="status" class="form-control">
									<?php
									for ($i=0; $i < count($stadodata); $i++) { 
										print '<option>' . $stadodata[$i]['sta_titulo'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<textarea name="obs" placeholder="Observaciones" class="form-control"></textarea>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<button id="sbmt" class="btn btn-success" class="form-control">Agregar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once 'inc/ft.inc'; ?>