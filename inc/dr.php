<?php
require_once 'ss.inc';
# Consulta

if ($_SESSION['rol'] == 'Supervisor') {

$sql = "SELECT * FROM tbl_ref;";
require_once 'Query.class.php';
$q = new Query($sql);
# Se llena el array con los datos de la consulta
$data = $q->query_array_assoc();
# Nombre de las columnas a aparecer en csv
$ncolum = ['ref_id' => 'ID Referencia',
              'ref_own'=> 'Referencia de agente',
              'ref_nom' => 'Nombre Referido',
              'ref_ape' => 'Apellido Referido',
              'ref_tel1' => 'Tel1 Referido',
              'ref_tel2' => 'Tel2 Referido',
              'ref_tel3' => 'Tel3 Referido',
              'ref_who' => 'Referente',
              'ref_status' => 'Estado',
              'ref_obs' => 'Observacion',
              'ref_fecha' => 'Fecha'];
# Se remplazan los keys
foreach ($data as $key => $value) {
    foreach($value as $k => $v){
      $data[$key][$ncolum[$k]] = $v;
      unset($data[$key][$k]);
     }
  }

# Enviar el download
ob_clean();
header("Content-type: text/x-csv");
header("Content-Transfer-Encoding: binary");
header("Content-Disposition: attachment; filename=Reporte_".date('d-m-Y_H',strtotime('now')).".csv");
header("Pragma: no-cache");
header("Expires: 0");

$file = fopen('php://temp/maxmemory:'. (12*1024*1024), 'r+'); // 128mb
fputcsv($file, array_keys(call_user_func_array('array_merge', $data)));
foreach($data as $row) {
    fputcsv($file, $row);
}
rewind($file);
$output = stream_get_contents($file);
fclose($file);
echo $output;
die();

}

if ($_SESSION['rol'] == 'Agente') {
  echo "Acceso denegado.";
}

?>