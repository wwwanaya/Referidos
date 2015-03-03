<?php
/**
 * Clase para referidos
 *
 * @package default
 * @author Kevin Anaya www.anaya@gmail.com
 **/
class Referido {

	private $own; // Quien lo mete
	private $nom; // Nombre del referido
	private $ape; // Apellido del referido
	private $tel1; // Telefono del referido
	private $tel2; // Telefono2 del referido
	private $tel3; // Telefono3 del referido
	private $who; // Quien lo refirio
	private $status; // Status
	private $obs; // Observacion

	public function __construct($own, $nom, $ape, $tel1, $tel2, $tel3, $who, $status, $obs) {
		$this->own = $own;
		$this->nom = $nom;
		$this->ape = $ape;
		$this->tel1 = $tel1;
		$this->tel2 = $tel2;
		$this->tel3 = $tel3;
		$this->who = $who;
		$this->status = $status;
		$this->obs = $obs;
	}

	public function check_duplicated(){
		$sql = "SELECT ref_nom, ref_ape, ref_tel1 FROM tbl_ref WHERE ref_nom LIKE '%$this->nom%' AND ref_ape LIKE '%$this->ape%' AND ref_tel1='$this->tel1';";
		require_once 'Query.class.php';
		$q = new Query($sql);
		return $q->query_numrows();
	}

	public function insert_it(){
		$sql = "INSERT INTO tbl_ref 
				(ref_own, ref_nom, ref_ape, ref_tel1, ref_tel2, ref_tel3, ref_who, ref_status, ref_obs) 
				VALUES 
				('$this->own', '$this->nom', '$this->ape', '$this->tel1', '$this->tel2', '$this->tel3', '$this->who', '$this->status', '$this->obs');";
		require_once 'Query.class.php';
		$q = new Query($sql);
		$q->insert_single_query();
	}

	public function update($ref_id){
		$sql = "UPDATE tbl_ref SET ref_own = '$this->own', ref_nom = '$this->nom', ref_ape = '$this->ape', ref_tel1 = '$this->tel1',
				ref_tel2 = '$this->tel2', ref_tel3 = '$this->tel3', ref_who = '$this->who', ref_status = '$this->status', ref_obs = '$this->obs' 
				WHERE ref_id = '$ref_id';";
		require_once 'Query.class.php';
		$q = new Query($sql);
		$q->insert_single_query();
	}

} 
?>