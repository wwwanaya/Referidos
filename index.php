<?php
include_once 'inc/hd.inc';

#sql del filtrado de estados:
	$sqlstado = "SELECT sta_titulo FROM tbl_status;";
	require_once 'inc/Query.class.php';
	$qstado = new Query($sqlstado);
	$stadodata = $qstado->query_array_assoc();

//var_dump($_POST);

#######################
# Eliminacion de refs #
#######################
if (isset($_POST['deletethis'])) {
	# Si dieron click en eliminar:
	foreach ($_POST as $key => $value) {
		# Crear variables dinamicamente enviadas por post.
		$$key = $value;
	}
	$delsql = "DELETE FROM tbl_ref WHERE ref_id = '$deletethis';";
	include_once 'inc/Query.class.php';
	$q = new Query($delsql);
	$q->exec_query();
}
?>

<?php
######################
# Pantalla de agente #
######################

if ($_SESSION['rol'] == 'Agente') {
	if (isset($_POST['fstatus'])) {
		foreach ($_POST as $key => $value) {
			# Crear variables dinamicamente enviadas por post.
			$$key = $value;
		}
	}

	#sql de referidos del agente primera pantalla:
	$own = $_SESSION['user'];

	# consulta por defecto:
	$sqlagent = "SELECT ref_id, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha 
			FROM tbl_ref WHERE ref_own='$own';";


	if (isset($fstatus)) {
		if ((strlen($fstatus) != 0) and (strlen($ffecha != 0))) {
			$sqlagent = "SELECT ref_id, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha 
			FROM tbl_ref WHERE ref_own='$own' AND ref_status='$fstatus'AND ref_fecha LIKE '%$ffecha%';";
		} elseif (strlen($fstatus) > 0) {
			$sqlagent = "SELECT ref_id, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha
			FROM tbl_ref WHERE ref_own='$own' AND ref_status='$fstatus';";
		} elseif (strlen($ffecha) > 0) {
			$sqlagent = "SELECT ref_id, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha
			FROM tbl_ref WHERE ref_own='$own' AND ref_fecha LIKE '%$ffecha%';";
		}
	}

	#se ejecuta la sql de referidos del agente primera pantalla:
	require_once 'inc/Query.class.php';
	$qagent = new Query($sqlagent);
	$dataagent = $qagent->query_array();

	# Si el usuario es un agente
	# Vera esta pantalla:

	require_once 'inc/nvag.inc';
	require_once 'inc/ag.inc';

	}
	#Termina la pantalla de agente.
	?>

<?php

############################
# Pantalla de Supervisores #
############################

if ($_SESSION['rol'] == 'Supervisor') {

	if (isset($_POST['fstatus'])) {
		foreach ($_POST as $key => $value) {
			# Crear variables dinamicamente enviadas por post.
			$$key = $value;
		}
	}

	# sql de referidos del supervisores:
	$sqlsup = "SELECT ref_id, ref_own, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha  FROM tbl_ref;";

	if (isset($fstatus)) {
		if ((strlen($fstatus) != 0) and (strlen($ffecha != 0))) {
			$sqlsup = "SELECT ref_id, ref_own, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha 
			FROM tbl_ref WHERE ref_status='$fstatus'AND ref_fecha LIKE '%$ffecha%';";
		} elseif (strlen($fstatus) > 0) {
			$sqlsup = "SELECT ref_id, ref_own, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha
			FROM tbl_ref WHERE ref_status='$fstatus';";
		} elseif (strlen($ffecha) > 0) {
			$sqlsup = "SELECT ref_id, ref_own, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs, ref_fecha
			FROM tbl_ref WHERE ref_fecha LIKE '%$ffecha%';";
		}
	}

	require_once 'inc/Query.class.php';
	$qsup = new Query($sqlsup);
	$datasup = $qsup->query_array();

	# Si el usuario es un supervisor
	# Vera esta pantalla:
	
	require_once 'inc/nvsup.inc';
	require_once 'inc/sup.inc';
	
	#Termina la pantalla de supervisor.
}
?>
<script type="text/javascript" src="js/calendario.js"></script>
<?php include_once 'inc/ft.inc'; ?>