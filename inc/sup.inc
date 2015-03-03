<input type="hidden" id="own" value=<?php print $_SESSION['user'];?>>
<input type="hidden" id="rol" value=<?php print $_SESSION['rol'];?>>
<style type="text/css">
	#btnf {
		width: 100%;
	}
</style>
<div class="container">

	<table class="table table-striped">
		<thead>
			<tr>
				<th colspan="3">Filtros</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Estado</th>
				<th colspan="2">Fecha</th>
			</tr>
			<tr>
				<form action="" method="post">
					<td>
						<select name="fstatus" class="form-control">
							<option></option>
							<?php
								for ($i=0; $i < count($stadodata); $i++) { 
									print '<option>' . $stadodata[$i]['sta_titulo'] . '</option>';
								}
							?>
						</select>
					</td>
					<td>
						<input type="text" name="ffecha" id="fecha" class="form-control" placeholder="Fecha">
					</td>
					<td>
						<button class="btn btn-success">Filtrar</button>
					</td>
				</form>
			</tr>
		</tbody>
	</table>
	

	<?php
	########################
	# Reasignacion de refs #
	########################

	#sql for agent list:
	$sqlagnts = "SELECT user_name, user_username FROM refe_user WHERE user_active='Y';";
	require_once 'inc/Query.class.php';
	$qagnts = new Query($sqlagnts);
	$agntsdata = $qagnts->query_array_assoc();

	if (isset($_POST['movethis'])) {
		# Cuando seleccionan un usuario
		# Para el nuevo ref:
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		$sqlmod = "UPDATE tbl_ref SET ref_own = '$assignto' WHERE ref_id ='$movethis';";
		require_once 'inc/Query.class.php';
		$qmod = new Query($sqlmod);
		$qmod->insert_single_query();
		header('Location: index.php');
	}

	#########################
	# /Reasignacion de refs #
	#########################

	######################
	# Edicion de referidos
	######################

	#sql for status list
	$sqlstado = "SELECT sta_titulo FROM tbl_status;";
	require_once 'inc/Query.class.php';
	$qstado = new Query($sqlstado);
	$stadodata = $qstado->query_array_assoc();

	if (isset($_POST['enom'])) {
		#Creacion de variables dinamicamente
		foreach ($_POST as $key => $value) {
			$$key = $value;
		}
		require_once 'inc/Referido.class.php';
		$r = new Referido($eown, $enom, $eape, $etel1, $etel2, $etel3, $ewho, $estatus, $eobs);
		$r->update($eid);
		header('Location: index.php');
	}
	#######################
	# /Edicion de referidos
	#######################

	?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th colspan="11">Referidos</th>
			</tr>
		</thead>
		<tbody id="tabla">
			<tr>
				<th>Agente</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Tel. Celular</th>
				<th>Tel. Empresa</th>
				<th>Tel. Casa</th>
				<th>Referente</th>
				<th>Estado</th>
				<th>Fecha</th>
				<th colspan="3">Opciones</th>
			</tr>
			
				<?php
				for ($i=0; $i < count($datasup); $i++) { 
					print '<tr class="removeme">';
					print '<td>' . $datasup[$i]['ref_own'] . '</td>';
					print '<td>' . $datasup[$i]['ref_nom'] . '</td>';
					print '<td>' . $datasup[$i]['ref_ape'] . '</td>';
					print '<td>' . $datasup[$i]['ref_tel1'] . '</td>';
					print '<td>' . $datasup[$i]['ref_tel2'] . '</td>';
					print '<td>' . $datasup[$i]['ref_tel3'] . '</td>';
					print '<td>' . $datasup[$i]['ref_who'] . '</td>';
					print '<td>' . $datasup[$i]['ref_status'] . '</td>';
					print '<td style="width: 100px">' . substr($datasup[$i]['ref_fecha'], 0, 10) . '</td>';
					print '<td><a class="btn btn-success" href="#" data-toggle="modal" data-target=".e' . $datasup[$i]['ref_id'] . '"><i class="fa fa-pencil-square-o"></i> Editar</a></td>';
					print '<td><a class="btn btn-info" href="#" data-toggle="modal" data-target=".t' . $datasup[$i]['ref_id'] . '"><i class="fa fa-exchange"></i> Transferir</a></td>';
					print '<td><a class="btn btn-danger" href="#" data-toggle="modal" data-target=".d' . $datasup[$i]['ref_id'] . '"><i class="fa fa-trash-o"></i> Eliminar</a></td>';
					print '</tr>';

					##########################
					# POPUP ELIMINAR REFERIDOS
					##########################
					print '<div class="modal fade d' . $datasup[$i]['ref_id'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
					print '<div class="modal-dialog modal-sm">';
					print '<div class="modal-content">';
					print '<div class="modal-header">';
					print '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					print '<h4 class="modal-title" id="myModalLabel">¿Eliminar referido?</h4>';
					print '</div>';
					print '<div class="modal-body">';

					#Data eliminar
					print '<div class="alert alert-danger" role="alert">';
					print '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
					print '<b> ' . $datasup[$i]['ref_nom'] . ' ' . $datasup[$i]['ref_ape'] . '<br> Cel.: ' . $datasup[$i]['ref_tel1'] . '</b>';
					print '</div>';

					print '</div>';
					print '<form action="" method="post">';
					print '<input type="hidden" name="deletethis" value="' . $datasup[$i]['ref_id'] . '">';
					print '<div class="modal-footer">';
					print '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
					print '<button type="submit" class="btn btn-danger">Si</button>';
					print '</form>';
					print '</div>';
					print '</div>';
					print '</div>';
					print '</div>';
					###########################
					# /POPUP ELIMINAR REFERIDOS
					###########################

					##########################
					# POPUP TRANSFERIR REFERIDOS
					##########################
					print '<div class="modal fade t' . $datasup[$i]['ref_id'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
					print '<div class="modal-dialog modal-sm">';
					print '<div class="modal-content">';
					print '<div class="modal-header">';
					print '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					print '<h4 class="modal-title" id="myModalLabel">¿Asignar a quien?</h4>';
					print '</div>';
					print '<div class="modal-body">';
					print '<form action="" method="post">';

					#Data transferir
					###################
					# ASSIGN TO AGENT #
					###################
					print '<select name="assignto" class="form-control">';
					for ($i2=0; $i2 < count($agntsdata); $i2++) { 
						print '<option value="' . $agntsdata[$i2]['user_username'] . '">' . $agntsdata[$i2]['user_name'] . '</option>';
					}
					print '</select>';
					####################
					# /ASSIGN TO AGENT #
					####################

					print '</div>';
					print '<input type="hidden" name="movethis" value="' . $datasup[$i]['ref_id'] . '">';
					print '<div class="modal-footer">';
					print '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
					print '<button type="submit" class="btn btn-info">Asignar</button>';
					print '</form>';
					print '</div>';
					print '</div>';
					print '</div>';
					print '</div>';
					###########################
					# /POPUP TRANSFERIR REFERIDOS
					###########################

					##########################
					# POPUP EDITAR REFERIDOS
					##########################
					print '<div class="modal fade e' . $datasup[$i]['ref_id'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
					print '<div class="modal-dialog modal-sm">';
					print '<div class="modal-content">';
					print '<div class="modal-header">';
					print '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					print '<h4 class="modal-title" id="myModalLabel">Editando...</h4>';
					print '</div>';
					print '<div class="modal-body">';

					#Data eliminar
					print '<form action="" method="post">';
					print '<input name="eown" type="hidden" value="' . $datasup[$i]['ref_own'] . '">';
					print '<input name="eid" type="hidden" value="' . $datasup[$i]['ref_id'] . '"';
					print '<label>Nombre: </label><input name="enom" type="text" class="form-control" value="' . $datasup[$i]['ref_nom'] . '">';
					print '<label>Apellido: </label><input name="eape" type="text" class="form-control" value="' . $datasup[$i]['ref_ape'] . '">';
					print '<label>Cel.: </label><input name="etel1" type="text" class="form-control" value="' . $datasup[$i]['ref_tel1'] . '">';
					print '<label>Tel. Empresa: </label><input name="etel2" type="text" class="form-control" value="' . $datasup[$i]['ref_tel2'] . '">';
					print '<label>Tel. Casa: </label><input name="etel3" type="text" class="form-control" value="' . $datasup[$i]['ref_tel3'] . '">';
					print '<label>Referente: </label><input name="ewho" type="text" class="form-control" value="' . $datasup[$i]['ref_who'] . '">';
					print '<label>Estado: </label>';
					print '<select name="estatus" class="form-control">';
					print '<option>'.$datasup[$i]['ref_status'].'</option>';
					for ($i3=0; $i3 < count($stadodata); $i3++) { 
						print '<option value="' . $stadodata[$i3]['sta_titulo'] . '">' . $stadodata[$i3]['sta_titulo'] . '</option>';
					}
					print '</select>';
					print '<label>Observación: </label>';
					print '<textarea name="eobs" placeholder="Observaciones" class="form-control">' . $datasup[$i]['ref_obs'] . '</textarea>';

					print '</div>';
					print '<form action="" method="post">';
					print '<input type="hidden" name="ethis" value="' . $datasup[$i]['ref_id'] . '">';
					print '<div class="modal-footer">';
					print '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
					print '<button type="submit" class="btn btn-success">Guardar cambios</button>';
					print '</form>';
					print '</div>';
					print '</div>';
					print '</div>';
					print '</div>';
					###########################
					# /POPUP EDITAR REFERIDOS
					###########################

				}

				?>
		</tbody>
	</table>
</div>