<?php 
/**
 * Query class
 *
 * @package default
 * @author  Kevin Anaya www.anaya@gmail.com
 **/

require_once 'Fck.class.php';

class Query extends Fck {

	private $sql;

	public function __construct($sql) 	{
		# Agarrar la consulta...
		$this->sql = $sql;

	}

	public function query_array() {


		if (!$this->sql == null) {
			# Si consulta NO esta vacio...
			
			/*
			//* Para debug. 
			print 'La consulta es: ' . $this->sql . '. ';*/
			

			return self::getCon()->query($this->sql)->fetch_all(MYSQLI_BOTH);

		} else {
			# Si no, mostrar error error...
			print 'No hay consulta: ' . $this->sql . '. ';
		}
		
	}

	public function query_array_assoc(){

		return self::getCon()->query($this->sql)->fetch_all(MYSQLI_ASSOC);

	}

	public function query_numrows() {
		self::query_array();
		return self::getCon()->query($this->sql)->num_rows;
	}

	public function query_numcol() {
		self::query_array();
		return self::getCon()->query($this->sql)->field_count;
	}

	public function insert_single_query() {
		return self::getCon()->query($this->sql);
	}

	public function exec_query() {
		return self::getCon()->query($this->sql);
	}
}
?>