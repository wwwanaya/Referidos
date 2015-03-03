<?php 
$fecha = $_POST['inputs_val']['0'];
$own = $_POST['inputs_val']['1'];
$rol = $_POST['inputs_val']['2'];
require_once 'inc/Query.class.php';
if ($rol == 'agente') {
	$sql = "SELECT * FROM tbl_ref WHERE ref_own='$own' AND ref_fecha LIKE  '%$fecha%';";
	$q = new Query($sql);
	$datos = $q->query_array_assoc();
}

if ($rol == 'sup') {
	$sql = "SELECT * FROM tbl_ref WHERE ref_fecha LIKE  '%$fecha%';";
	$q = new Query($sql);
	$datos = $q->query_array_assoc();
}

//var_dump($datos);
//echo $sql;

if (count($datos) == 0) {
	print '0';
} else {

	if ($rol == 'agente') {

		for ($i=0; $i < count($datos); $i++) { 
		# code...
		print '<tr class="removeme">';
		print '<td>' . ($datos[$i]['ref_nom']) . '</td>';
		print '<td>' . ($datos[$i]['ref_ape']) . '</td>';
		print '<td>' . ($datos[$i]['ref_tel1']) . '</td>';
		print '<td>' . ($datos[$i]['ref_tel2']) . '</td>';
		print '<td>' . ($datos[$i]['ref_tel3']) . '</td>';
		print '<td>' . ($datos[$i]['ref_who']) . '</td>';
		print '<td>' . ($datos[$i]['ref_status']) . '</td>';
		print '<td>' . ($datos[$i]['ref_obs']) . '</td>';
		print '<td>' . (substr($datos[$i]['ref_fecha'], 0, 10)) . '</td>';
		print '<form action="" method="post">';
		print '<td><button class="btn btn-danger">Eliminar<input type="hidden" name="del" value="'. $datos[$i]['ref_id'] .'"></button></td>';
		print '</form>';
		print '</tr>';
		}

	} 

	if ($rol == 'sup') {

		for ($i=0; $i < count($datos); $i++) { 
		# code...
		print '<tr class="removeme">';
		print '<td>' . ($datos[$i]['ref_own']) . '</td>';
		print '<td>' . ($datos[$i]['ref_nom']) . '</td>';
		print '<td>' . ($datos[$i]['ref_ape']) . '</td>';
		print '<td>' . ($datos[$i]['ref_tel1']) . '</td>';
		print '<td>' . ($datos[$i]['ref_tel2']) . '</td>';
		print '<td>' . ($datos[$i]['ref_tel3']) . '</td>';
		print '<td>' . ($datos[$i]['ref_who']) . '</td>';
		print '<td>' . ($datos[$i]['ref_status']) . '</td>';
		print '<td>' . (substr($datos[$i]['ref_fecha'], 0, 10)) . '</td>';
		print '<form action="" method="post">';
		print '<td><button value="'. $datos[$i]['ref_id'] .'" class="btn btn-danger">Eliminar<input type="hidden" name="del" value="'. $datos[$i]['ref_id'] .'"></button></td>';
		print '</form>';
		print '<form action="" method="post">';
		print '<td><button class="btn btn-info">Trasferir<input type="hidden" name="trasf" value="'. $datos[$i]['ref_id'] .'"></button></td>';
		print '</form>';
		print '</tr>';
		}

	}

}
?>