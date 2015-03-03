<style type="text/css">
	#btnf {
		width: 100%;
	}
</style>
<div class="container">
	<div id="divsubmit"></div>
	<div class="container">
		<table class="table table-bordered">
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
							<button id="btnf" class="btn btn-success">Filtrar</button>
						</td>
					</form>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th colspan="10">Mis referidos</th>
				</tr>
			</thead>
			<tbody id="tabla">
				<tr>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Tel. Celular</th>
					<th>Tel. Empresa</th>
					<th>Tel. Casa</th>
					<th>Referente</th>
					<th>Estado</th>
					<th>Observación</th>
					<th>Fecha</th>
					<th>Opciones</th>
				</tr>
				
					<?php
					for ($i=0; $i < count($dataagent); $i++) { 
						print '<tr class="removeme">';
						print '<td>' . $dataagent[$i]['ref_nom'] . '</td>';
						print '<td>' . $dataagent[$i]['ref_ape'] . '</td>';
						print '<td>' . $dataagent[$i]['ref_tel1'] . '</td>';
						print '<td>' . $dataagent[$i]['ref_tel2'] . '</td>';
						print '<td>' . $dataagent[$i]['ref_tel3'] . '</td>';
						print '<td>' . $dataagent[$i]['ref_who'] . '</td>';
						print '<td>' . $dataagent[$i]['ref_status'] . '</td>';
						print '<td>' . $dataagent[$i]['ref_obs'] . '</td>';
						print '<td style="width: 100px">' . substr($dataagent[$i]['ref_fecha'], 0, 10) . '</td>';
						print '<td><a class="btn btn-danger" href="#" data-toggle="modal" data-target=".d' . $dataagent[$i]['ref_id'] . '"><i class="fa fa-trash-o"></i> Eliminar</a></td>';
						print '</tr>';

						##########################
						# POPUP ELIMINAR REFERIDOS
						##########################
						print '<div class="modal fade d' . $dataagent[$i]['ref_id'] . '" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">';
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
						print '<b> ' . $dataagent[$i]['ref_nom'] . ' ' . $dataagent[$i]['ref_ape'] . '<br> Cel.: ' . $dataagent[$i]['ref_tel1'] . '</b>';
						print '</div>';

						print '</div>';
						print '<form action="" method="post">';
						print '<input type="hidden" name="deletethis" value="' . $dataagent[$i]['ref_id'] . '">';
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

					}

					?>
				
			</tbody>
		</table>
	</div>