<?php
/**
 * Clase para referidos
 *
 * @package default
 * @author Kevin Anaya www.anaya@gmail.com
 * 2015 / Enero / 16
 **/
class Usuario {

	private $user; // Username
	private $pw; // Password
	private $rol; // Rol
	private $nom; // Nombre y apellido

	public function __construct($user, $pw, $rol, $nom) {
		$this->user = $user;
		$this->pw = $pw;
		$this->rol = $rol;
		$this->nom = $nom;
	}

	public function check_duplicated(){
		$sql = "SELECT user_username FROM refe_user WHERE user_username='$this->user';";
		require_once 'Query.class.php';
		$q = new Query($sql);
		return $q->query_numrows();
	}

	public function insert_it(){
		$pw = hash("whirlpool", $this->pw);
		$prfx = md5('$%');
		$pwtoDB = hash("sha512", $prfx.$pw);
		$sql = "INSERT INTO refe_user 
				(user_username, user_pass, user_rol, user_name, user_active) 
				VALUES 
				('$this->user', '$pwtoDB', '$this->rol', '$this->nom', 'Y');";
		require_once 'Query.class.php';
		$q = new Query($sql);
		$q->insert_single_query();
	}

	public function update(){
		$sql = "UPDATE refe_user SET user_username = '$this->user',
			user_rol = '$this->rol', user_name = '$this->nom', user_pass = '$this->pw' WHERE user_username = '$this->user';";
		require_once 'Query.class.php';
		$q = new Query($sql);
		$q->insert_single_query();
	}

} 
?>